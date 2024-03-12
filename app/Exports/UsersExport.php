<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = User::whereHas('role', function ($role) {
            $role->where('role', User::ROLE_CLIENT);
        })
            ->with('activity', 'manager')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('exports.clients', [
            'data' => $data
        ]);
    }
}
