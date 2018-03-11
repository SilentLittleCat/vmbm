<?php

use Illuminate\Database\Seeder;

class AdminSuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->where('name', 'admin')->delete();
        DB::table('admin_users')->insert([
            'name' => 'admin',
            'real_name' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'admin@163.com',
            'mobile' => '123456',
            'avatar' => 'http://webimg-handle.liweijia.com/upload/avatar/avatar_0.jpg',
            'type' => 0,
            'is_root' => 1
        ]);
    }
}
