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

        //Administrator
        $newuser = new User();
        $newuser->name = "Admin";
        $newuser->email = "admin@mail.com";
        $newuser->password = bcrypt("123456");
        $newuser->permission_id = 1;
        $newuser->status = 1;
        $newuser->created_by = 1;
        $newuser->save();
    }
}
