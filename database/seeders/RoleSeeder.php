<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Usuario']);

        
        Permission::create(['name' => 'producto.create'])->assignRole($role1);
        Permission::create(['name' => 'producto.destroy'])->assignRole($role1);
        Permission::create(['name' => 'producto.edit'])->assignRole($role1);
        Permission::create(['name' => 'producto.index'])->assignRole($role1);

        Permission::create(['name' => 'users.update'])->assignRole($role1);
        Permission::create(['name' => 'users.destroy'])->assignRole($role1);
        Permission::create(['name' => 'users.edit'])->assignRole($role1);
        Permission::create(['name' => 'users.index'])->assignRole($role1);

        Permission::create(['name' => 'welcome'])->syncRoles($role1, $role2);
        Permission::create(['name' => 'inico'])->syncRoles($role1, $role2);
    }
}