<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // Beranda untuk pengunjung dan admin
    public function beranda(Request $request)
    {
        $totalMenu = DB::table('menu')->count();

        $query = DB::table('menu')->orderByDesc('id');

        if (in_array($request->query('kategori'), [
            'Makanan', 'Minuman', 'Dessert'
        ])) {
            $query->where('kategori', $request->query('kategori'));
        }

        $menu = $query->get();

        return view('index', compact('totalMenu', 'menu'));
    }

    // Daftar menu bisa dilihat semua orang
    public function index()
    {
        $menu = DB::table('menu')->orderBy('id', 'desc')->get();

        return view('menu', compact('menu'));
    }   

    // Form tambah hanya untuk admin
    public function create()
    {
        return view('tambah_menu');
    }

    // Menyimpan menu
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'kategori' => 'required|in:Makanan,Minuman,Dessert',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
        ]);

        DB::table('menu')->insert($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $menu = DB::table('menu')->where('id', $id)->first();

        abort_if(!$menu, 404, 'Menu tidak ditemukan.');

        return view('edit_menu', compact('menu'));
    }

    // Menyimpan perubahan
    public function update(Request $request, $id)
    {
        $menu = DB::table('menu')->where('id', $id)->first();

        abort_if(!$menu, 404, 'Menu tidak ditemukan.');

        $data = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'kategori' => 'required|in:Makanan,Minuman,Dessert',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
        ]);

        DB::table('menu')->where('id', $id)->update($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    // Menghapus menu
    public function destroy($id)
    {
        $menu = DB::table('menu')->where('id', $id)->first();

        abort_if(!$menu, 404, 'Menu tidak ditemukan.');

        DB::table('menu')->where('id', $id)->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil dihapus!');
    }
}
