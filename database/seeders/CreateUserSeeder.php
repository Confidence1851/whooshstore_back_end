<?php
  namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
   
class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'firstname'=>'Admin',
               'email'=>'admin@email.com',
               'role'=>'0',
               'is_admin'=>'1',
               'password'=> bcrypt('password'),
            ],
            [
               'firstname'=>'Vendor',
               'email'=>'user@email.com',
               'role'=>'1',
                'is_admin'=>'0',
               'password'=> bcrypt('123456'),
            ],
            [
               'firstname'=>'User',
               'email'=>'user2@email.com',
               'role'=>'2',
                'is_admin'=>'0',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
