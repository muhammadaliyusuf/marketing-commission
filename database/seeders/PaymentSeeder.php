<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\PaymentInstallment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        // Daftar pilihan term length yang tersedia
        $termOptions = [3, 6, 9, 12];

        // Daftar pilihan payment method
        $paymentMethods = ['cash', 'credit'];

        // Ambil semua data penjualan
        $penjualanList = Sale::all();

        foreach ($penjualanList as $penjualan) {
            // Pilih random payment method
            $selectedPaymentMethod = $paymentMethods[array_rand($paymentMethods)];

            // Pilih random term_length jika credit
            $selectedTerm = $selectedPaymentMethod === 'credit'
            ? $termOptions[array_rand($termOptions)]
                : null;

            $payment = Payment::create([
                'payment_number' => 'PAY-' . time() . '-' . $penjualan->id,
                'sale_id' => $penjualan->id,
                'amount' => $penjualan->total_balance,
                'payment_method' => $selectedPaymentMethod,
                'status' => $selectedPaymentMethod === 'cash' ? 'paid' : 'pending',
                'term_length' => $selectedTerm,
                'due_date' => $selectedPaymentMethod === 'cash'
                    ? Carbon::now()
                    : Carbon::now()->addMonths($selectedTerm)
            ]);

            // Buat installment hanya jika payment method adalah credit
            if ($selectedPaymentMethod === 'credit') {
                // Hitung jumlah cicilan per bulan
                $installmentAmount = $payment->amount / $selectedTerm;

                // Buat cicilan sesuai term length yang terpilih
                for ($i = 1; $i <= $selectedTerm; $i++) {
                    PaymentInstallment::create([
                        'payment_id' => $payment->id,
                        'installment_amount' => $installmentAmount,
                        'installment_number' => $i,
                        'due_date' => Carbon::now()->addMonths($i),
                        'status' => 'pending'
                    ]);
                }
            }
        }
    }
}