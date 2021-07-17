<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => '1',
            'name' => '山田　太郎',
            'email' => 'taro@example.com',
            'password' => 'password'
        ];
        $item = new User;
        $item->fill($param)->save();

        $param = [
            'id' => '2',
            'name' => '鈴木　二郎',
            'email' => 'jiro@example.com',
            'password' => 'password'
        ];
        $item = new User;
        $item->fill($param)->save();

        $param = [
            'id' => '3',
            'name' => '佐藤　三郎',
            'email' => 'saburo@example.com',
            'password' => 'password'
        ];
        $item = new User;
        $item->fill($param)->save();
    }
}
