<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $name = env('ADMIN_NAME');
        $email = env('ADMIN_EMAIL');
        $password = bcrypt(env('ADMIN_PASSWORD'));

        if (empty($name) || empty($password) || empty($email)) {
            dd('Name or password is empty in .env');
        }

        return true;

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $user = \App\User::create([
                'name' => $name,
                'login' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => $password
            ]);

            \App\Models\Role::create([
                'user_id' => $user->id,
                'role' => $user::ROLE_ADMIN
            ]);

            $country = \App\Models\Country::create([
                'name_uz' => 'Узбекистан',
                'name_ru' => 'Узбекистан',
                'name_en' => 'Узбекистан',
                'type' => \App\Models\Country::POINT_B
            ]);

            \App\Models\City::create([
                'country_id' => $country->id,
                'name_uz' => 'Ташкент',
                'name_ru' => 'Ташкент',
                'name_en' => 'Ташкент',
            ]);

            \App\Models\Setting::create([
                'meta_title->ru' => 'TOTRANS'
            ]);

            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $exception) {
            \Illuminate\Support\Facades\DB::rollBack();
            throw new DomainException($exception->getMessage());
        }
    }
}
