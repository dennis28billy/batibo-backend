<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 10000);
        $isOrder = $request->input('isOrder');
        $status = $request->input('status');


        if($id)
        {
            $transaction = transaction::with(['user'])->find($id);

            if($transaction){
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
            }
        }

        $transaction = transaction::with(['user', 'address'])->where('user_id', Auth::user()->id);

        if($isOrder)
   	{
             $transaction->where('isOrder', $isOrder);
        }

        if($status)
        {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data list transaksi berhasil diambil'
        );
    }

    //fungsi opsional
    public function update(Request $request, $id)
    {
        $transaction = transaction::findOrFail($id);

        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi berhasil diperbarui');
    }

    public function delete($id)
    {
        $transaction = transaction::findOrFail($id);

        $transaction->delete();

        return ResponseFormatter::success($transaction, 'Transaksi berhasil dihapus');
    }

    public function checkout(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address_id' => 'required',
            'total' => 'required',
            'ongkosKirim' => 'required',
            'status' => 'required',
	    'uid' => 'required',
	    'nama_penerima' => 'required',
	    'nomor_handphone' => 'required',
	    'email' => 'required',
	    'alamat_penerima' => 'required',
	    'latitude' => 'required',
	    'longitude' => 'required'
        ]);

        $transaction = transaction::create([
	    'uid' => 'GD - '.$request->uid.$request->user_id,
            'user_id' => $request->user_id,
            'address_id' => $request->address_id,
            'total' => $request->total,
            'ongkosKirim' => $request->ongkosKirim,
            'status' => $request->status,
            'payment_url' => '',
            'isOrder' => $request->isOrder,
	    'nama_penerima' => $request->nama_penerima,
	    'nomor_handphone' => $request->nomor_handphone,
	    'email' => $request->email,
	    'alamat_penerima' => $request->alamat_penerima,
	    'latitude' => $request->latitude,
	    'longitude' => $request->longitude
        ]);

        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Panggil transaksi yang dibuat
        $transaction = transaction::with(['user', 'address'])->find($transaction->id);

        // Membuat transaksi midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,

            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];            

        // Memanggil midtrans

        try {
            //ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            //Mengembalikan Data ke API
            return ResponseFormatter::success($transaction, 'Transaksi berhasil');
        } 
        catch (Exception $e){
            return ResponseFormatter::error($e->getMessage(), 'Transaksi gagal');
        }
        // Mengembalikan data ke API
    }
}
