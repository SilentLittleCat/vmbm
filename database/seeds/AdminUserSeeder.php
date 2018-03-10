<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'name' => 'user2',
            'real_name' => 'user2',
            'password' => bcrypt('123456'),
            'email' => 'user2@163.com',
            'mobile' => '123456',
            'avatar' => 'http://webimg-handle.liweijia.com/upload/avatar/avatar_0.jpg',
            'type' => 0,
            'is_root' => 1
        ]);
    }
}
