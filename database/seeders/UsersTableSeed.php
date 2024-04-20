<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            [
                'name'=>'Admin',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'User',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ];
        Role::insert($roles);
        $users = [
            [
                'name'=>'Nelson Sammy',
                'email'=>'nelson@polling.com',
                'password'=>Hash::make('secret'),
                'created_at'=>now(),
                'updated_at'=>now(),
                'role_id'=>1
            ],
        ];
        User::insert($users);
    }
}
