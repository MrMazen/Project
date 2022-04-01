<?php
use Illuminate\Database\Seeder;
use App\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Abdelftahmahmoud',
            'email' => 'owner@yahoo.com',
            'password' => bcrypt('123456'),
            'usertype' => 1,

        ]);
       
    }
}
