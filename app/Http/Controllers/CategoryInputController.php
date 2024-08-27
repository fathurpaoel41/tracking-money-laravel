<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletModel;
use Illuminate\Support\Str;
use App\Models\CategoryInputModel;

class CategoryInputController extends Controller
{
    public function viewCategory(){
        return view('content/categoryInput');
    }

    public function getCategories($page = 1){
        $perPage = 10;
        $categories = CategoryInputModel::paginate($perPage, ['*'], 'page', $page);
        return response()->json($categories);
    }

    public function createCategoryInput(Request $request){
        $request->validate([
            'nama_pemasukan' => 'required',
            'deskripsi_kategori_pemasukan' => 'required',
            'icon_pemasukan' => 'nullable',
        ]);

        $query = CategoryInputModel::create([
            'kategori_pemasukan_id' =>  Str::uuid()->toString(),
            'nama_pemasukan' => $request->nama_pemasukan,
            'id_user' => Auth::user()->id_user,
            'deskripsi_kategori_pemasukan' => $request->deskripsi_kategori_pemasukan,
            'icon_pemasukan' => $request->icon_pemasukan?? null,
        ]);

        return redirect()->route('categoryHome')->with('success', 'Berhasil Menambahkan Wallet');
    }

    public function deleteCategoriesInput($kategori_pemasukan_id){
        $category = CategoryInputModel::where('kategori_pemasukan_id', $kategori_pemasukan_id)->first();

        if ($category) {
            $deleted = CategoryInputModel::where('kategori_pemasukan_id', $kategori_pemasukan_id)->delete();
            // return redirect()->route('categoryHome')->with('success', 'Berhasil Menghapus Kategori Pemasukan');
        } else {
            // return redirect()->route('categoryHome')->with('error', 'Gagal Menghapus Kategori Pemasukan: Data tidak ditemukan');
        }
    }
}
