<?php

namespace App\Imports;

use App\Pelanggan;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PelangganImport implements ToModel, WithValidation, WithStartRow
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
            '0' => 'required|unique:tb_pelanggan,nipnas',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
            '7' => 'required',
            '8' => 'required',
            '9' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'NIPNAS is required.',
            '0.unique' => 'NIPNAS already been taken',
            '1.required' => 'Nama Pelanggan is required.',
            '2.required' => 'AM is required.',
            '3.required' => 'Email Pelanggan is required.',
            '4.required' => 'Phone is required.',
            '5.required' => 'BA is required.',
            '6.required' => 'SID is required.',
            '7.required' => 'ALamat is required.',
            '8.required' => 'Latitude is required.',
            '9.required' => 'Longitude is required.',
        ];
    }

    public function model(array $row)
    {
        return new Pelanggan([
            'nipnas'            => $row[0],
            'nama_pelanggan'    => $row[1],
            'user_id'           => User::where('nama_user', $row[2])->value('id'),
            'email_pelanggan'   => $row[3],
            'phone'             => $row[4],
            'ba'                => $row[5],
            'sid'               => $row[6],
            'alamat'            => $row[7],
            'latitude'          => $row[8],
            'longitude'         => $row[9],
        ]);
    }
}
