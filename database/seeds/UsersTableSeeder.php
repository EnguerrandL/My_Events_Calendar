<?php
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    // création de d'un utilisateur admin qui sera enregistré dans la base de donnée
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'logged user',
            'email' => 'test@test.fr',
            'password' => bcrypt('test'),
        ]);
    }
}

