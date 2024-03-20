<?php

namespace App\Imports;

use App\Models\District;
use App\Models\Manager;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClientImport implements ToCollection, WithMultipleSheets, WithLimit, WithStartRow
{

    const COLUMN_NAME = 0;
    const COLUMN_LOGIN = 1;
    const COLUMN_PHONE = 2;
    const COLUMN_REGION = 3;
    const COLUMN_EMAIL = 4;
    const COLUMN_COMPANY = 5;
    const COLUMN_MANAGER_NAME = 6;
    const COLUMN_REGISTRATION_DATE = 7;

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function collection(Collection $rows): bool
    {
        User::whereHas('role', function ($q) {
            $q->where('role', User::ROLE_CLIENT);
        })->delete();

        $regions = collect(District::all());
        $managers = collect(Manager::all());

        $data = [];

        foreach ($rows as  $row) {
            $district = $regions->where('name_ru', 'ilike', $row[self::COLUMN_REGION])->first();
            $manager = $managers->where('name_ru', 'ilike', $row[self::COLUMN_MANAGER_NAME])->first();

            if (empty($row[0])) {
                continue;
            }

            if (empty($row[1])) {
                break;
            }

            $data[] = [
                "name" => $row[self::COLUMN_NAME],
                'login' => (string)$row[self::COLUMN_LOGIN],
                "phone_string" => $row[self::COLUMN_PHONE],
                "email" => $row[self::COLUMN_EMAIL],
                "company_name" => $row[self::COLUMN_COMPANY],
                "district_id" => ($district instanceof District) ? $district->id : null,
                "manager_id" => ($manager instanceof Manager) ? $manager->id : null,
                'password' => bcrypt(Str::random(10))
            ];
        }

        if (count($data) > 0) {
            DB::table('users')->insert($data);
            $roles = User::doesntHave('role')->select(['id as user_id', DB::raw("'client' as role")])->get()->toArray();
            DB::table('roles')->insert($roles);
        }

        return true;
    }

    public function startRow(): int
    {
        return 801;
    }

    public function limit(): int
    {
        return 400;
    }
}
