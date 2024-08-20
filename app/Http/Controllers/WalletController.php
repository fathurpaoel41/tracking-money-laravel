<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\WalletModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function viewWallet()
    {
        $dataWallet = WalletModel::where('id_user', Auth::id())->get();
        $countWallet = $dataWallet->count();

        return view("content.wallet", [
            'dataWallet' => $dataWallet,
            'countWallet' => $countWallet
        ]);
    }

    public function addWallet(Request $request)
    {
        $request->validate([
            'nama_dompet' => 'required',
            'deskripsi_dompet' => 'required'
        ]);

        $walletCount = WalletModel::where('id_user', Auth::id())->count();

        if ($walletCount >= 3) {
            return redirect()->route('wallet')->with('error', 'Tidak dapat menambahkan wallet baru. Jumlah maksimal wallet adalah 3.');
        }

        $wallet = WalletModel::create([
            'id_dompet' => Str::uuid()->toString(),
            'id_user' => Auth::id(),
            'nama_dompet' => $request->nama_dompet,
            'deskripsi_dompet' => $request->deskripsi_dompet
        ]);

        return redirect()->route('wallet')->with('success', 'Berhasil Menambahkan Wallet');
    }
}
