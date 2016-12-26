<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->truncate();

      factory(App\User::class)->create([
        'name' => 'dwikuntobayu',
        'email'=>'dwikunto@geeksfarm.com',
        // 'password'=>Crypt::encrypt('12345678'),
        'password'=>app('hash')->make('12345678'),
      ]);

      factory(App\User::class, 2)->create();
    }
}
