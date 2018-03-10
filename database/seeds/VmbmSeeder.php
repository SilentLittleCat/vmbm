<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class VmbmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileSystem = new Filesystem();
        $database = $fileSystem->get(base_path('database/seeds') . '/' . 'vmbm.sql');
        DB::connection()->getPdo()->exec($database);
    }
}
