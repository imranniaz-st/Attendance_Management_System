<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class StoreEmployeeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:employee_data';


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
        // first truncate the table
        DB::connection('mysql')->table('employees')->delete();

        // get data from DB 1
        $data = DB::connection('second_db')->table('employees')->get();
        foreach ($data as $info) {
            DB::connection('mysql')->table('employees')->insert([
                'emp_id' => $info->id,
                'name' => $info->name,
                'position' => $info->designation_id,
                'email' => $info->email,
                // 'position' => $info->designation_id,
                // 'position' => $info->designation_id,
                // 'position' => $info->designation_id,
            ]);
        }
    }
}
