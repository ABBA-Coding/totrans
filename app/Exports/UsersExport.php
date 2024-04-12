<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromView, ShouldAutoSize, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = User::whereHas('role', function ($role) {
            $role->where('role', User::ROLE_CLIENT);
        })
            ->with('activity', 'manager', 'district')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('exports.clients', [
            'data' => $data
        ]);
    }

    public function columnFormats(): array {
        return [
            'D' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
