<?php

namespace App\Imports;

use App\Guru;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuruImport implements ToModel, WithValidation, WithStartRow
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
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'NIP is required.',
            '1.required' => 'Nama Guru is required.',
            '2.required' => 'Jenis Kelamin is required.',
            '3.required' => 'Mapel is required.',
        ];
    }

    public function model(array $row)
    {
        return new Guru([
            'nip'            => $row[0],
            'nama_guru'    => $row[1],
            'jenis_kelamin'   => $row[2],
            'mapel'             => $row[3],
        ]);
    }
}
