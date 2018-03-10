<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileSystem = new Filesystem();
        $database = $fileSystem->get(base_path('database/seeds') . '/' . 'admin_menus.sql');
        DB::connection()->getPdo()->exec($database);
    }
}
