<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Like;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
            $area = Area::where('id', $item->area_id)->first();
            $item->area_name = $area->name;
            $genre = Genre::where('id', $item->genre_id)->first();
            $item->genre_name = $genre->name;
            $like = Like::where('shop_id', $item->id)->get();
            $item->like = $like;
            $review = Review::where('shop_id', $item->id)->get();
            $item->review = $review;
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
        $item = Shop::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
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
