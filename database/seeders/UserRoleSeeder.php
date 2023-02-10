<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at'     => Carbon::now(),
            'remember_token'        => Str::random(100),
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
            'image'                 => null
        ];

        $sales = User::create(array_merge([
            'name'          => 'Sales',
            'email'         => 'sales@gmail.com',
            'password'      => Hash::make('password'),
        ], $default_user_value));

        $warehouse = User::create(array_merge([
            'name'          => 'Warehouse',
            'email'         => 'warehouse@gmail.com',
            'password'      => Hash::make('password'),
        ], $default_user_value));

        $superadmin = User::create(array_merge([
            'name'          => 'Super Admin',
            'email'         => 'superadmin@gmail.com',
            'password'      => Hash::make('password'),
        ], $default_user_value));

        $cashier = User::create(array_merge([
            'name'          => 'Cashier',
            'email'         => 'cashier@gmail.com',
            'password'      => Hash::make('password'),
        ], $default_user_value));

        $role_super_admin = Role::create(['name'    =>  'Super Admin']);
        $role_sales = Role::create(['name'    =>  'Sales']);
        $role_warehouse = Role::create(['name'    =>  'Warehouse']);
        $role_casheer = Role::create(['name'    =>  'Cashier']);

        $superadmin->assignRole('Super Admin');
        $sales->assignRole('Sales');
        $warehouse->assignRole('Warehouse');
        $cashier->assignRole('Cashier');
    }
}
