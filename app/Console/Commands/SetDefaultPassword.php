<?php

namespace App\Console\Commands;

use App\Imports\ClientImport;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SetDefaultPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:default-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        print_r('start...');

        $count = User::whereHas('role', function ($role) {
            $role->where('role', User::ROLE_CLIENT);
        })
            ->where('login', '<>', 'AN-1453')
            ->whereDate('created_at', '2024-03-21')
            ->update(['password' => bcrypt('wt7nOtFJ')]);

        print_r("\n");
        print_r('updated: '.$count.' rows');
        print_r("\n");
        print_r('finish');

        return 'success';
    }
}
