<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Petugas;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class PetugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $adminPermissions = ['create','read','update','delete'];
        foreach($adminPermissions as $ap){
            $permission = Permission::create(['name' => $ap]);
            $adminRole->givePermissionTo($permission);
        }
        $adminUser = Petugas::create([
            'nama_petugas' => 'Admin',
            'username' => 'admin123',
            'password' => Hash::make('asdasd'),
            'telp' => '083120847424'
        ]);
        $adminUser->assignRole($adminRole);

        $petugasRole = Role::create(['name' => 'petugas']);
        $petugasPermissions = ['create','read','update','delete'];
        foreach($petugasPermissions as $pp){
            $petugasRole->givePermissionTo($pp);
        }
        $petugasUser = Petugas::create([
            'nama_petugas' => 'petugas',
            'username' => 'petugas123',
            'password' => Hash::make('asdasd'),
            'telp' => '083120847424'
        ]);
        $petugasUser->assignRole($petugasRole);
    }
}
