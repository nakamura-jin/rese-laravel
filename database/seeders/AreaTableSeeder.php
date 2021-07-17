<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '東京都'
        ];
        $item = new Area;
        $item->fill($param)->save();

        $param = [
            'name' => '大阪府'
        ];
        $item = new Area;
        $item->fill($param)->save();

        $param = [
            'name' => '福岡県'
        ];
        $item = new Area;
        $item->fill($param)->save();
    }
}
