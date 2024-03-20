<?php

namespace App\Console\Commands;

use App\Imports\ClientImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportClient extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:client
    {startRow : Start Number}';

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
        $startRow = $this->argument('startRow');

        print_r('start...');

        Excel::import(new ClientImport($startRow), base_path('public/clients.xlsx'));

        print_r("\n");
        print_r('finish');

        return 'success';
    }
}
