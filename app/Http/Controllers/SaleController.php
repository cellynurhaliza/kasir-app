<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Imports\SaleImport;
use App\Models\Detail_sale;
use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function indexEmployee(Request $request)
    {
        $detail_sale = Detail_sale::all();
        $sales = Sale::with('member', 'user')->orderBy('id', 'desc')->get();
        return view('employee.sale.index', compact('sales', 'detail_sale'));
    }

    public function indexAdmin(Request $request)
    {
        $detail_sale = Detail_sale::all();
        $sales = Sale::with('member', 'user')->orderBy('id', 'desc')->get();
        return view('admin.sale.index', compact('sales', 'detail_sale'));
    }

    public function create()
    {
        $products = Product::all();
        return view('employee.sale.create', compact('products'));
    }

    public function store(Request $request)
    {
        $products = $request->products;

        if (empty($products)) {
            return redirect()->back()->with('failed', 'Pilih produk terlebih dahulu.');
        }

        $data['products'] = [];
        $data['total'] = 0;
        foreach ($products as $product) {
            $product = explode(';', $product);
            $id = $product[0];
            $name = $product[1];
            $price = $product[2];
            $quantity = $product[3];
            $subtotal = $product[4];

            $data['products'][] = [
                'product_id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'sub_total' => $subtotal,
            ];
            $data['total'] += $subtotal;
        }

        return view('employee.sale.payment', $data);
    }

    public function paymentProccess(Request $request)
    {
        $products = $request->shop;
        $sales_products = [];
        $total_pay = (int)str_replace(['Rp. ', '.'], '', $request->total_pay);
        $total = (int)$request->total;
        $member_id = null;
        $used_point = 0;
        $discount = 0;

        if ($request->member == 'Member') {
            $telephone = $request->telephone;
            $name = $request->name;
            $existMember = Member::where('telephone', $telephone)->first();

            if ($existMember) {
                $used_point = min($existMember->point, $total); // Gunakan sebanyak mungkin, tapi tidak melebihi total
                $discount = $used_point;

                // Update sisa poin setelah dipakai
                $existMember->point -= $used_point;

                // Simpan poin tambahan dari transaksi ini, nanti ditambah setelah Sale dibuat
                $newPoint = $total / 100;

                $existMember->save();
                $member_id = $existMember->id;
            } else {
                $newPoint = $total / 100;
                $newMember = Member::create([
                    'name' => $name,
                    'telephone' => $telephone,
                    'point' => 0, // Belum dapat poin karena transaksi belum selesai
                ]);
                $member_id = $newMember->id;
            }
        }

        $sale = Sale::create([
            'sale_date' => now(),
            'member_id' => $member_id,
            'total_price' => $total,
            'discount' => $discount,
            'total_pay' => $total_pay,
            'total_return' => $total_pay - ($total - $discount),
            'user_id' => Auth::user()->id,
            'sales_products' => implode(', ', $sales_products) ?? '',
            'point' => $newPoint ?? 0, // poin yang didapat dari transaksi ini
            'used_point' => $used_point
        ]);

        foreach ($products as $product) {
            $product = explode(';', $product);
            $id = $product[0];
            $name = $product[1];
            $price = number_format($product[2], 0, ',', '.');
            $quantity = (int)$product[3];
            $subtotal = (int)$product[4];

            $sales_products[] = "{$name} ( {$quantity} : Rp. {$price} )";

            $productModel = Product::find($id);
            if ($productModel) {
                $productModel->update(['stock' => $productModel->stock - $quantity]);
            }

            Detail_sale::create([
                'sale_id' => $sale->id,
                'product_id' => $id,
                'quantity' => $quantity,
                'sub_total' => $subtotal,
            ]);
        }

        $sale->update(['sales_products' => implode("\n", $sales_products)]);

        // Tambahkan poin hasil transaksi ke member (jika ada)
        if ($request->member == 'Member') {
            $member = Member::find($member_id);
            $member->point += $newPoint ?? 0;
            $member->save();
            return redirect()->route('employee.sale.member', $sale->id);
        }

        return redirect()->route('employee.sale.print', $sale->id);
    }


    public function member($id)
    {
        $sale = Sale::findOrFail($id);
        $isFirst = Sale::where('member_id', $sale->member_id)->count() == 1 ? true : false;
        $detail_sale = Detail_sale::where('sale_id', $sale->id)->get();
        return view('employee.sale.member', compact('sale', 'detail_sale', 'isFirst'));
    }

    public function updateSale(Request $request, $id)
    {
        $sale = Sale::with('member')->findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if ($request->check_poin == 'Ya') {
            $sale->update([
                'used_point' => $sale->member->point,
                'total_price' => $sale->total_price,
                'discount' => $sale->total_price - $sale->member->point,
                'total_return' => $sale->total_pay - $sale->discount,
            ]);
            $sale->member->update([
                'name' => $request->name,
                'point' => 0,
            ]);
        } else {
            $sale->member->update([
                'name' => $request->name,
            ]);
        }
        return redirect()->route('employee.sale.print', $sale->id);
    }

    public function print($id)
    {
        $sale = Sale::with('member', 'user')->findOrFail($id);
        $detail_sale = Detail_sale::where('sale_id', $sale->id)->with('product')->get();
        return view('employee.sale.print', compact('sale', 'detail_sale'));
    }

    public function exportPDF($id)
    {
        $sale = Sale::with('member', 'user')->findOrFail($id);
        $detail_sale = Detail_sale::where('sale_id', $sale->id)->with('product')->get();

        $data = [
            'sale' => $sale,
            'detail_sale' => $detail_sale,
            'isMember' => $sale->member != null,
        ];
        $pdf = Pdf::loadView('employee.sale.pdf', $data);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('receipt.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new SalesExport, 'laporan-penjualan.xlsx');
    }
}
