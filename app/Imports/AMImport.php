<?php

namespace App\Imports;
use Illuminate\Support\Facades\Auth;

use App\AM;
use App\Notification;
use App\Produk;
use App\StatusTransaksi;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
class AMImport implements ToCollection, WithValidation, WithStartRow
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
            '0.required' => 'Pelanggan is required.',
            '1.required' => 'ID Product is required.',
            '2.required' => 'Progress is required.',
            '3.required' => 'ID Status Transaksi is required.',
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $model = new AM();
            $model->user_id = Auth::user()->id;
            $model->pelanggan = $row[0];
            $model->product_id = Produk::where('nama_produk', $row[1])->value('id');
            $model->progress = $row[2];
            $model->status_transaksi_id = StatusTransaksi::where('status_transaksi', $row[3])->value('id');
            $model->save();
        }
    }
}
