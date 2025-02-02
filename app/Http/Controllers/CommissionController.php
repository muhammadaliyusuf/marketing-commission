<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $hasil = $this->hitungKomisi();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $hasil
            ]);
        }

        return view('index', ['komisi' => $hasil]);
    }

    public function hitungKomisi()
    {
        $sales = Sale::with('marketing')
        ->selectRaw('marketing_id, MONTH(date) as bulan, SUM(total_balance) as omzet')
        ->groupBy('marketing_id', 'bulan')
        ->get();

        // Hitung komisi untuk setiap sales
        $hasil = $sales->map(function ($data) {
            if (!$data->marketing) {
                return null;
            }

            $komisi_persen = $this->hitungPersentaseKomisi($data->omzet);

            return [
                'marketing' => $data->marketing->name,
                'bulan' => $this->namaBulan($data->bulan),
                'omzet' => $data->omzet,
                'komisi_persen' => $komisi_persen,
                'komisi_nominal' => ($komisi_persen / 100) * $data->omzet
            ];
        })->filter();

        return $hasil;
    }

    /**
     * Hitung persentase komisi berdasarkan omzet.
     *
     * @param float $omzet
     * @return float
     */
    private function hitungPersentaseKomisi($omzet)
    {
        if ($omzet >= 500000000) {
            return 10;
        } elseif ($omzet >= 200000000) {
            return 5;
        } elseif ($omzet >= 100000000) {
            return 2.5;
        }

        return 0;
    }

    /**
     * Konversi angka bulan ke nama bulan.
     *
     * @param int $bulan
     * @return string
     */
    private function namaBulan($bulan)
    {
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return $namaBulan[$bulan] ?? 'Bulan Tidak Valid';
    }
}