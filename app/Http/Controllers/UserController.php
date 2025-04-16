<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\Detail_sale;
use App\Models\Sale;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('admin.user.edit', compact('users'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'role' => 'required|string',
            'password' => 'nullable|string'
        ]);

        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role = $request->role;
        if ($request->filled('password')) {
            $users->password = bcrypt($request->password);
        }

        $users->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new UserExport, 'laporan-user.xlsx');
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
}
