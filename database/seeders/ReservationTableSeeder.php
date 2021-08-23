<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'shop_id' => 1,
            'date' => '2021-10-10',
            'time' => '17:00',
            'people' => 2
        ];
        $item = new Reservation;
        $item->fill($param)->save();

    }
}
