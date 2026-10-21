<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function katalog()
    {
        $products = Product::all();
        return view('katalog', compact('products'));
    }

    public function pesan()
    {
        $products = Product::all();
        return view('pesan', compact('products'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'nomor_hp' => 'required',
            'produk_pilihan' => 'required',
            'jumlah' => 'required|numeric',
            'alamat' => 'required',
        ]);

        Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'nomor_hp' => $request->nomor_hp,
            'produk_pilihan' => $request->produk_pilihan,
            'jumlah' => $request->jumlah,
            'alamat' => $request->alamat,
            'status' => 'Baru',
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }

    public function health()
    {
        try {
            DB::connection()->getPdo();
            return response('OK', 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            return response('Database Connection Error', 500);
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Email atau Password salah!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil Logout.');
    }

    public function adminDashboard(Request $request)
    {
        $search = $request->input('search');
        $products = Product::when($search, function($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('kategori', 'like', "%{$search}%")
                         ->orWhere('varian', 'like', "%{$search}%");
        })->get();

        $orders = Order::latest()->get();

        $totalProduk = Product::count();
        $pesananBaru = Order::where('status', 'Baru')->count();
        $dalamProses = Order::where('status', 'Diproses')->count();
        $pesananSelesai = Order::where('status', 'Selesai')->count();
        $pesananTerbaru = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'products', 'orders', 'totalProduk',
            'pesananBaru', 'dalamProses', 'pesananSelesai',
            'pesananTerbaru', 'search'
        ));
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'varian' => 'required',
        ]);
        Product::create($request->all());
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function updateProduk(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->back()->with('success', 'Data produk berhasil diupdate!');
    }

    public function uploadGambar(Request $request, int $id)
    {
        $request->validate([
            'gambar_baru' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $product = Product::findOrFail($id);

        if ($file = $request->file('gambar_baru')) {
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $product->gambar = 'images/' . $imageName;
            $product->save();
        }
        return redirect()->back()->with('success', 'Gambar ' . $product->nama . ' berhasil diperbarui!');
    }

    public function destroyProduk(int $id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function updateStatusPesanan(Request $request, int $id)
    {
        $request->validate(['status' => 'required']);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroyPesanan(int $id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Riwayat pesanan dihapus!');
    }
}