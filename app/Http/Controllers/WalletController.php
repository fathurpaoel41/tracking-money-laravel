<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletModel;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function viewWallet(){
        $dataWallet = WalletModel::get();
        
        // // Menghitung jumlah wallet menggunakan loop
        // $countWallet = 0;
        // foreach ($dataWallet as $wallet) {
        //     $countWallet++;
        // }
    
        // Atau menggunakan fungsi count() PHP
        $countWallet = count($dataWallet);
    
        return view("content.wallet", [
            'dataWallet' => $dataWallet,
            'countWallet' => $countWallet
        ]);
    }

    public function addWallet(Request $request){
        $request->validate([
            'nama_dompet' => 'required',
            'deskripsi_dompet' => 'required'
        ]);

        $wallet = WalletModel::create([
            'id_dompet' => \Illuminate\Support\Str::uuid()->toString(),
            'id_user' => Auth::user()->getAttributes()['id_user'],
            'nama_dompet' => $request->nama_dompet,
            'deskripsi_dompet' => $request->deskripsi_dompet
        ]);

        return redirect()->route('wallet')->with('success', 'Berhasil Menambahkan Wallet');
}
}
