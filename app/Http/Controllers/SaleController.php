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
        $sales = Sale::with('member', 'user')->orderBy('id', 'desc')->get();
        return view('employee.sale.index', compact('sales'));
    }

    public function indexAdmin(Request $request)
    {

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
}

