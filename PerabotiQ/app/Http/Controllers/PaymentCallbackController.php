<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function receive(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            // Midtrans test dashboard might send invalid/dummy signature
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 200);
        }

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        
        // Extract original Transaksi ID (format: transaksi_id-timestamp)
        $idParts = explode('-', $orderId);
        $transaksiId = $idParts[0];

        $transaksi = Transaksi::find($transaksiId);

        if (!$transaksi) {
            // Midtrans test dashboard uses a dummy order_id
            return response()->json(['status' => 'error', 'message' => 'Transaksi tidak ditemukan'], 200);
        }

        $pesanan = Pesanan::find($transaksi->pesanan_id);

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $transaksi->update(['status' => 'lunas']);
            if ($pesanan) {
                // If payment is successful, mark order as being processed
                $pesanan->update(['status' => 'diproses']);
            }
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $transaksi->update(['status' => 'gagal']);
            if ($pesanan) {
                $pesanan->update(['status' => 'dibatalkan']);
            }
        } else if ($transactionStatus == 'pending') {
            $transaksi->update(['status' => 'pending']);
            if ($pesanan) {
                $pesanan->update(['status' => 'menunggu_pembayaran']);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Notification processed successfully']);
    }
}
