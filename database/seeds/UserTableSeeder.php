<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User;
      $user->name = 'test';
      $user->email = 'test@gmail.com';
      $user->password = Hash::make('belajar');
      $user->save();
    }
}
