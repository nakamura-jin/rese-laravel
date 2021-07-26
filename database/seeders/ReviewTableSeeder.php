<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 'sxVMeYTirdaG3AoSWtkEspxiDE63',
            'shop_id' => 1,
            'star' => 4
        ];
        $item = new Review;
        $item->fill($param)->save();

        $param = [
            'user_id' => 'syIEKDuAmdRCkVqYemd2S2Quufk2',
            'shop_id' => 2,
            'star' => 4
        ];
        $item = new Review;
        $item->fill($param)->save();

        $param = [
            'user_id' => 'sxVMeYTirdaG3AoSWtkEspxiDE63',
            'shop_id' => 2,
            'star' => 2
        ];
        $item = new Review;
        $item->fill($param)->save();

    }
}
