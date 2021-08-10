<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Reservation;
use App\Models\User;

class OwnerController extends Controller
{
    public function index()
    {
        $items = Owner::all();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $item = Owner::find($id);
        // ショップ情報取得
        $shop = Shop::where('owner_id', $id)->first();
        $item->shop_id = $shop->id;
        $item->shopname = $shop->shopname;
        $item->overview = $shop->overview;
        $item->image = $shop->image;
        // エリア名取得
        $area_id = $shop->area_id;
        $area = Area::find($area_id);
        $item->area_name = $area->name;
        // ジャンル名取得
        $genre_id = $shop->genre_id;
        $genre = Genre::find($genre_id);
        $item->genre_name = $genre->name;
        // レビュー
        $review = Review::where('shop_id', $shop->id)->get();
        $item->review = $review;

        $reservation = Reservation::where('shop_id', $shop->id)->get();
        $item->reservation = $reservation;

        // $user = User::where('user_id', $reservation->user_id);
        // $item->user = $user->id;

        if ($item) {
            return response()->json([
                'data' => $item
            ]);
        }
    }
}
