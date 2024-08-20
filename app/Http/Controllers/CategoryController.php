<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletModel;
use Illuminate\Support\Str;
use App\Models\CategoryInputModel;

class CategoryController extends Controller
{
    public function viewCategory(){
        return view('content/categoryInput');
    }

    public function getCategories($page = 1){
        $perPage = 10;
        $categories = CategoryInputModel::paginate($perPage, ['*'], 'page', $page);
        return response()->json($categories);
    }

    public function createCategoryInput(Request $request)
{
    $validatedData = $request->validate([
        'nama_pemasukan' => 'required',
        'deskripsi_kategori_pemasukan' => 'required',
        'icon_pemasukan' => 'nullable',
    ]);

    $categoryInput = new CategoryInputModel();
    $categoryInput->kategori_pemasukan_id = Str::uuid()->toString();
    $categoryInput->nama_pemasukan = $validatedData['nama_pemasukan'];
    $categoryInput->id_user = Auth::id();
    $categoryInput->deskripsi_kategori_pemasukan = $validatedData['deskripsi_kategori_pemasukan'];
    $categoryInput->icon_pemasukan = $validatedData['icon_pemasukan'] ?? null;

    $categoryInput->save();

    return redirect()->route('categoryHome')->with('success', 'Berhasil Menambahkan Wallet');
}
}
