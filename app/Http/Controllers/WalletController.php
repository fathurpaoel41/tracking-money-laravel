<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletModel;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function viewWallet(){
        return view("content.wallet");
    }

    public function addWallet(Request $request){
        $request->validate([
            'nama_dompet' => 'required',
            'deskripsi_dompet' => 'required'
        ]);

        $user = Auth::user();
        // dd($user);

        $wallet = WalletModel::create([
            'id_dompet' => \Illuminate\Support\Str::uuid()->toString(),
            'id_user' => $user->id,
            'nama_dompet' => $request->nama_dompet,
            'deskripsi_dompet' => $request->deskripsi_dompet
        ]);

        return redirect()->route('wallet')->with('success', 'Berhasil Menambahkan Wallet');
}
}
