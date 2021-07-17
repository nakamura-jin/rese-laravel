<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '寿司'
        ];
        $item = new Genre;
        $item->fill($param)->save();

        $param = [
            'name' => '焼肉'
        ];
        $item = new Genre;
        $item->fill($param)->save();

        $param = [
            'name' => '居酒屋'
        ];
        $item = new Genre;
        $item->fill($param)->save();

        $param = [
            'name' => 'イタリアン'
        ];
        $item = new Genre;
        $item->fill($param)->save();

        $param = [
            'name' => 'ラーメン'
        ];
        $item = new Genre;
        $item->fill($param)->save();
    }
}
