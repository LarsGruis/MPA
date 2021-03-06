<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //factory(App\Student::class, 100)->create();

        // DB::table('categories')->insert([
        //     'name' => str_random(10),
        // ]);
        $this->call([
            CategorySeeder::class,
        ]);
    }
}
