<?php
  namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
   
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
               'role'=>'1',
               'password'=> bcrypt('password'),
            ],
            [
               'firstname'=>'Michael',
               'lastname'=>'Johnathan',
               'email'=>'user1@email.com',
               'role'=>'2',
               'password'=> bcrypt('123456'),
            ],
            [
               'firstname'=>'Harry',
               'lastname'=>'Kane',
               'email'=>'user2@email.com',
               'role'=>'0',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }

        //create 50 vendors
        User::factory()
            ->times(50)
            ->create();
    }
}
