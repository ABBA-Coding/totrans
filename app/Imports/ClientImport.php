<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\District;
use App\Models\Manager;
use App\User;
use Carbon\Carbon;
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
    const COLUMN_SURNAME = 1;
    const COLUMN_LOGIN = 2;
    const COLUMN_PASSWORD = 3;
    const COLUMN_PHONE = 4;
    const COLUMN_REGION = 5;
    const COLUMN_EMAIL = 6;
    const COLUMN_COMPANY = 7;
    const COLUMN_ACTIVITY = 8;
    const COLUMN_MANAGER_NAME = 9;
    const COLUMN_BIRTHDAY = 10;

    public $startRowNumber = 1;

    public function __construct($startRow)
    {
        $this->startRowNumber = $startRow;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function collection(Collection $rows): bool
    {
        $regions = District::select('id', 'name_ru')->pluck('id', 'name_ru');
        $managers = Manager::select('id', 'name_ru')->pluck('id', 'name_ru');
        $activity = Activity::select('id', 'title_ru')->pluck('id', 'title_ru');

        $data = [];

        foreach ($rows as  $row) {
            if (empty($row[0])) {
                break;
            }

            $password = !empty($row[self::COLUMN_PASSWORD]) ? $row[self::COLUMN_PASSWORD] : Str::random(8);
            $login = !empty((string)$row[self::COLUMN_LOGIN]) ? (string)$row[self::COLUMN_LOGIN] : User::generateLogin();

            $data[] = [
                "name" => $row[self::COLUMN_NAME],
                "surname" => $row[self::COLUMN_SURNAME],
                'login' => $login,
                'password' => bcrypt($password),
                "phone_string" => $row[self::COLUMN_PHONE],
                "phone" => $row[self::COLUMN_PHONE],
                "email" => $row[self::COLUMN_EMAIL],
                "company_name" => $row[self::COLUMN_COMPANY],
                "district_id" => $regions[$row[self::COLUMN_REGION]] ?? null,
                "manager_id" => $managers[$row[self::COLUMN_MANAGER_NAME]] ?? null,
                "activity_id" => $activity[$row[self::COLUMN_ACTIVITY]] ?? null,
                'created_at' => Carbon::now()
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
        return $this->startRowNumber;
    }

    public function limit(): int
    {
        return 150;
    }
}
