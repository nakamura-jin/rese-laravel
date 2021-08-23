<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 'testowner',
            'name' => '佐藤　三郎',
            'email' => 'saburo@example.com',
            'password' => 'password'
        ];
        $item = new Owner;
        $item->fill($param)->save();
    }
}
