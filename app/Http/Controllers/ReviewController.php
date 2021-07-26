<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        $items = Review::all();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, Review::$rules);
        $createReview = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'star' => $request->star
        ];
        $item = Review::create($createReview);
        return response()->json([
            'data' => $item
        ], 201);

    }

    public function show(Request $request){
        $id = $request->user_id;
        $items = Review::where('user_id', $id)->get();

        if($items)
        {
            return response()->json([
                'data' => $items
            ], 200);
        } else {
            return response()->json([
                'message' => '見つかりません'
            ], 404);
        }
    }

}
