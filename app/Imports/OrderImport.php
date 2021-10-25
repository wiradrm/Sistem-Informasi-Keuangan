<?php

namespace App\Imports;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Order;
use App\Transaksi;
use App\StatusTransaksi;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OrderImport implements ToModel, WithValidation, WithStartRow
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
            '0.required' => 'Tanggal PS is required.',
            '1.required' => 'ID Transaksi is required.',
            '2.required' => 'ID Status Transaksi is required.',
            '3.required' => 'ID AM Pelanggan is required.',
            '4.required' => 'NIPNAS Pelanggan is required.',
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'tgl_ps'                => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])),
            'transaksi_id'          => Transaksi::where('keterangan', $row[1])->value('id'),
            'status_transaksi_id'   => StatusTransaksi::where('status_transaksi', $row[2])->value('id'),
            'user_id'               => User::where('nama_user', $row[3])->value('id'),
            'inputer_id'            => Auth::user()->id,
            'pelanggan_id'          => $row[4]
        ]);
    }
}
