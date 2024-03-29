<?php

namespace App\Imports;

use App\User;
use App\Anggaran;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AnggaranImport implements ToModel, WithValidation, WithStartRow
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
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'Jenis Anggaran is required.',
            '2.required' => 'Nama Anggaran is required.',

            '3.required' => 'Jumlah is required.',
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anggaran([
            'jenis_anggaran'           => $row[0],
            'anggaran'           => $row[1],

            'jumlah'     => $row[2],
        ]);
    }
}
