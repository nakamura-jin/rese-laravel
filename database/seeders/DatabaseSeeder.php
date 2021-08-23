<?php

namespace Database\Seeders;

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
        $this->call(UserTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(GenreTableSeeder::class);
        $this->call(OwnerTableSeeder::class);
        $this->call(ShopTableSeeder::class);
        $this->call(LikeTableSeeder::class);
        $this->call(ReservationTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
    }
}
