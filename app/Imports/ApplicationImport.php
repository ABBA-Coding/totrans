<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\Application;
use App\Models\Batch;
use App\Models\City;
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

class ApplicationImport implements ToCollection, WithMultipleSheets, WithLimit, WithStartRow
{
    const COLUMN_BATCH_NUMBER = 0;
    const COLUMN_DELIVERY_TYPE = 1;
    const COLUMN_POINT_A = 2;
    const COLUMN_POINT_B = 3;
    const COLUMN_ORDER_DATE = 4;
    const COLUMN_PRICE = 5;
    const COLUMN_SEATS_NUMBER = 6;
    const COLUMN_QUANTITY = 7;
    const COLUMN_WEIGHT = 8;
    const COLUMN_VOLUME = 9;
    const COLUMN_ACTIVITY = 10;
    const COLUMN_NAME = 11;
    const COLUMN_SURNAME = 12;
    const COLUMN_LOGIN = 13;
    const COLUMN_PASSWORD = 14;
    const COLUMN_PHONE = 15;
    const COLUMN_REGION = 16;
    const COLUMN_EMAIL = 17;
    const COLUMN_COMPANY = 18;
    const COLUMN_MANAGER_NAME = 19;
    const COLUMN_BIRTHDAY = 20;

    public $startRowNumber = 1;
    public $cities;
    public $regions;
    public $managers;
    public $activities;

    public function __construct($startRow)
    {
        $this->startRowNumber = $startRow;
        $this->cities = City::select('id', 'name_ru')->pluck('id', 'name_ru');
        $this->regions = District::select('id', 'name_ru')->pluck('id', 'name_ru');
        $this->managers = Manager::select('id', 'name_ru')->pluck('id', 'name_ru');
        $this->activities = Activity::select('id', 'title_ru')->pluck('id', 'title_ru');
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function collection(Collection $rows): bool
    {
        foreach ($rows as  $row) {
            if (empty($row[0])) {
                break;
            }

            $user = $this->createOrFindUser($row);

            $this->createApplication($row, $user);
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

    private function createApplication($row, $user)
    {
        $cities = $this->cities;
        $batches = Batch::select('id', 'batch_number')->pluck('id', 'batch_number');

        Application::create([
            'batch_id' => $batches[$row[self::COLUMN_BATCH_NUMBER]] ?? null,
            'application_number' => Str::random(6),
            'user_id' => $user->id,
            'delivery_type' => Application::getDeliveryType($row[self::COLUMN_DELIVERY_TYPE]),
            'point_a_id' => $cities[$row[self::COLUMN_POINT_A]] ?? null,
            'point_b_id' => $cities[$row[self::COLUMN_POINT_B]] ?? null,
            'order_date' => $row[self::COLUMN_ORDER_DATE] ?? null,
            'price' => $row[self::COLUMN_PRICE] ?? null,
            'seats_number' => $row[self::COLUMN_SEATS_NUMBER] ?? null,
            'mileage' => $row[self::COLUMN_QUANTITY] ?? null,
            'weight' => $row[self::COLUMN_WEIGHT] ?? null,
            'volume' => $row[self::COLUMN_VOLUME] ?? null,
        ]);
    }

    private function createOrFindUser($row)
    {
        $regions = $this->regions;
        $managers = $this->managers;
        $activity = $this->activities;

        $user = null;

        if (!empty((string)$row[self::COLUMN_LOGIN])) {
            $user = User::where('login', $row[self::COLUMN_LOGIN])->first();
        }

        if ($user == null) {
            $password = !empty($row[self::COLUMN_PASSWORD]) ? $row[self::COLUMN_PASSWORD] : Str::random(8);
            $login = !empty((string)$row[self::COLUMN_LOGIN]) ? (string)$row[self::COLUMN_LOGIN] : User::generateLogin();

            $user = User::create([
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
            ]);

            DB::table('roles')->insert([
                'user_id' => $user->id,
                'role' => 'client'
            ]);
        }

        return $user;
    }
}
