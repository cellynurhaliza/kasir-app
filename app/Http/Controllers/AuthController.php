<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.home')->with('success', 'Login berhasil!');
            } elseif ($user->role === 'employee') {
                return redirect()->route('employee.home')->with('success', 'Login berhasil!');
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    public function adminPage()
    {
        $sales = Sale::selectRaw("DATE(CONVERT_TZ(created_at, '+00:00', '+07:00')) as date, COUNT(*) as total_sales")
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = $sales->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d F Y'))->toArray();
        $salesCount = $sales->pluck('total_sales')->toArray();

        $productSales = DB::table('sales')
            ->join('detail_sales', 'sales.id', '=', 'detail_sales.sale_id')
            ->join('products', 'detail_sales.product_id', '=', 'products.id')
            ->selectRaw('products.name as product_name, SUM(detail_sales.quantity) as total_sold')
            ->groupBy('product_name')
            ->get();

        $productNames = $productSales->pluck('product_name')->toArray();
        $productTotals = $productSales->pluck('total_sold')->toArray();

        $products = Product::select('name', 'stock')->get();
    $productNames = $products->pluck('name');
    $productStock = $products->pluck('stock');

        return view('admin.dashboard', compact('dates', 'salesCount', 'productNames', 'productTotals', 'productStock'));
    }

    public function employeePage()
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $totalSales = Sale::whereDate('created_at', Carbon::today())->count();

        $memberSales = Sale::join('users', 'sales.user_id', '=', 'users.id')
            ->whereDate(DB::raw("CONVERT_TZ(sales.created_at, '+00:00', '+07:00')"), $today)
            ->where('sales.member_id', 1)
            ->count();

        $nonMemberSales = Sale::join('users', 'sales.user_id', '=', 'users.id')
            ->whereDate(DB::raw("CONVERT_TZ(sales.created_at, '+00:00', '+07:00')"), $today)
            ->where('sales.member_id', 0)
            ->count();

        $salesCountToday = Sale::whereDate('created_at', $today)->count();
        $latestTransaksi = Sale::latest()->first();
        $users = User::all();


        return view('employee.dashboard', compact(
            'totalSales',
            'users',
            'latestTransaksi',
        ));
    }
}
