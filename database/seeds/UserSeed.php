<?php

use Illuminate\Database\Seeder;
use App\user;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=user::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('12345678')
        ]);
        $user->assignRole('admin');
        $user->givePermissionTo('akses_pelanggan');
        $user->givePermissionTo('akses_petugas');
        $user->givePermissionTo('akses_laporan');

    }
}
