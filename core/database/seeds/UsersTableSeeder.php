<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Administrator (ALL ACTION)
        // $newuser = new User();
        // $newuser->name = "Super Admin";
        // $newuser->email = "sa@mail.com";
        // $newuser->password = bcrypt("123456");
        // $newuser->permission_id = 1;
        // $newuser->status = 1;
        // $newuser->created_by = 1;
        // $newuser->save();

        //Administrator
        $newuser = new User();
        $newuser->name = "Admin";
        $newuser->email = "admin@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 1;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();

        //PPK
        $newuser = new User();
        $newuser->name = "PPK";
        $newuser->email = "ppk@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 2;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();

        //WD2
        $newuser = new User();
        $newuser->name = "Wakil Dekan 2";
        $newuser->email = "wd2@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 3;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();

        //BPP
        $newuser = new User();
        $newuser->name = "BPP";
        $newuser->email = "bpp@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 4;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();

        //Administrator
        $newuser = new User();
        $newuser->name = "Kasubag";
        $newuser->email = "kasubag@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 5;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();

        //Prodi
        $newuser = new User();
        $newuser->name = "Prodi";
        $newuser->email = "prodi@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 6;
        $newuser->unit_id = 1;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();

        //Ormawa 
        $newuser = new User();
        $newuser->name = "Ormawa";
        $newuser->email = "ormawa@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 6;
        $newuser->unit_id = 2;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();

        //Ormawa 1
        $newuser = new User();
        $newuser->name = "Ormawa1";
        $newuser->email = "ormawa1@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 6;
        $newuser->unit_id = 3;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();
    }
}
