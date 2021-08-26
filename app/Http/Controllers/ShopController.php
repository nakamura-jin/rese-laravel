<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Like;
use App\Models\Review;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Shop::all();
        foreach ($items as $item) {
            // エリア
            $area = Area::where('id', $item->area_id)->first();
            $item->area_name = $area->name;
            // ジャンル
            $genre = Genre::where('id', $item->genre_id)->first();
            $item->genre_name = $genre->name;
            // お気に入り
            $like = Like::where('shop_id', $item->id)->get();
            $item->like = $like;
            // レビュー
            $review = Review::where('shop_id', $item->id)->get();
            $item->review = $review;
            // 予約
            $reservation = Reservation::where('shop_id', $item->id)->get();
            $item->reservation = $reservation;

        }

        return response()->json([
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, Shop::$rules);
        // $createShop = [
        //     'shopname' => $request->shopname,
        //     'overview' => $request->overview,
        //     'area_id' => $request->area_id,
        //     'genre_id' => $request->genre_id,
        //     'image' => $request->image,
        //     'owner_id' => $request->owner_id
        // ];

        // $item = Shop::create($createShop);
        // return response()->json([
        //     'data' => $item
        // ], 201);
        Storage::disk('s3')->put('/', $request->file('image'), 'public');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $item = Shop::where('id', $id)->first();
        // エリア名取得
        $area_id = $item->area_id;
        $area = Area::find($area_id);
        $item->area_name = $area->name;
        // ジャンル名取得
        $genre_id = $item->genre_id;
        $genre = Genre::find($genre_id);
        $item->genre_name = $genre->name;
        // レビュー
        $review = Review::where('shop_id', $id)->get();
        $item->review = $review;
        // 予約
        $reservation = Reservation::where('shop_id', $id)->get();
        $item->reservation = $reservation;

        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => '該当のお店が見当たりません'
            ], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $item = Shop::where('id', $shop->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted sucessfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }
    }
}
