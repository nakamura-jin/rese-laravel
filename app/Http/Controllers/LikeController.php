<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = Like::all();
        // foreach ($items as $item) {
        //     $user = User::where('id', $item->user_id)->first();
        //     $item->user_id = $user->id;
        //     $shop = Shop::where('id', $item->shop_id)->first();
        //     $item->shop_name = $shop->name;
        // }
        // return response()->json([
        //     'data' => $items
        // ], 200);
        $items = Like::all();
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
        $this->validate($request, Like::$rules);
        $createLike = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id
        ];
        $item = Like::create($createLike);
        return response()->json([
            'data' => $item
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $items = Like::where('user_id', $id)->get();

        foreach ($items as $item) {
            //　ショップ情報取得
            $shop_id = $item->shop_id;
            $shop = Shop::find($shop_id);
            $item->shopname = $shop->shopname;
            $item->overview = $shop->overview;
            $item->image = $shop->image;
            // エリア取得
            $area_id = $shop->area_id;
            $area = Area::find($area_id);
            $item->area_name = $area->name;
            // ジャンル取得
            $genre_id = $shop->genre_id;
            $genre = Genre::find($genre_id);
            $item->genre_name = $genre->name;
        }

        if ($items) {
            return response()->json([
                'data' => $items
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
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $item = Like::where('id', $id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'お気に入り店舗は取り消されました'
            ], 200);
        } else {
            return response()->json([
                'message' => 'エラーでお気に入り店舗取り消しできませんでした'
            ], 400);
        }
    }
}
