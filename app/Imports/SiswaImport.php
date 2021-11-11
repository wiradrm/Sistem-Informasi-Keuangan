<?php

namespace App\Imports;

use App\Siswa;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithValidation, WithStartRow
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
            '5' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'NISN is required.',
            '1.required' => 'Nama Siswa is required.',
            '2.required' => 'Tempat Lahir is required.',
            '3.required' => 'Tanggal Lahir is required.',
            '4.required' => 'Alamat is required.',
            '5.required' => 'Jenis Kelamin is required.',
        ];
    }

    public function model(array $row)
    {
        return new Siswa([
            'nisn'            => $row[0],
            'nama_siswa'    => $row[1],
            'tempat'             => $row[2],
            'tanggal'             => $row[3],
            'alamat'             => $row[4],
            'jenis_kelamin'   => $row[5],
        ]);
    }
}
