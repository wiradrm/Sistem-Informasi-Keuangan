<?php

namespace App\Imports;

use App\Bayar;
use App\Anggaran;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BayarImport implements ToModel, WithValidation, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'Jenis Anggaran is required.',
            '1.required' => 'Nama Anggaran is required.',
            '2.required' => 'Nama Anggaran is required.',

            '3.required' => 'Jumlah is required.',
            '4.required' => 'Nama Anggaran is required.',
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Bayar([
            'nisn'           => $row[0],
            'kode_spp'           => $row[1],
            'bulan'           => $row[2],

            'jumlah'     => $row[3],
            'status_transaksi'           => $row[4],

        ]);
    }
}
