<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::query()->insert([
            'name'=>'Admin',
            'type'=>0,
            'email'=>'admin@admin.loc',
            'password'=>\Illuminate\Support\Facades\Hash::make('admin123')
        ]);
    }
}
