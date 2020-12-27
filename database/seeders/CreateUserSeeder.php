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
               'name'=>'Admin',
               'email'=>'admin@email.com',
               'role'=>'1',
               'password'=> bcrypt('password'),
            ],
            [
               'name'=>'User',
               'email'=>'user@email.com',
               'role'=>'0',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
