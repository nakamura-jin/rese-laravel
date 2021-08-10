<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request) {
        $id = $request->id;
        $items = Reservation::where('user_id', $id)->get();

        // リレーション先のデータ取得(元が複数(get())のためforeachでそれぞれのショップ取得する)
        foreach ($items as $item) {
            $shop_id = $item->shop_id;
            $shop = Shop::find($shop_id);
            $item->shopname = $shop->shopname;

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

    public function store(Request $request)
    {
        $this->validate($request, Reservation::$rules);
        $createReservation = [
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'people' => $request->people
        ];
        $item = Reservation::create($createReservation);
        return response()->json([
            'data' => $item
        ], 200);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $item = Reservation::find($id);

        // ショップ名取得
        $shop_id = $item->shop_id;
        $shop = Shop::find($shop_id);
        $item->shopname = $shop->shopname;

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

    public function update(Request $request)
    {
        $update = [
            'date' => $request->date,
            'time' => $request->time,
            'people' => $request->people
        ];
        $id = $request->id;
        $item = Reservation::find($id)->update($update);

        if($item) {
            return response()->json([
                'data' => $item
            ], 201);
        } else {
            return response()->json([
                'message' => '変更できませんでした'
            ], 404);
        }

    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $item = Reservation::where('id', $id)->delete();
        if ($item) {
            return response()->json([
                'message' => '予約は取り消されました'
            ], 200);
        } else {
            return response()->json([
                'message' => 'エラーで予約取り消しできませんでした'
            ], 400);
        }
    }

    public function shop_reservation(Request $request) {
        $id = $request->id;
        $items = Reservation::where('shop_id', $id)->get();
        foreach($items as $item) {
            $user_id = $item->user_id;
            $user = User::find($user_id);
            $item->user_name = $user->name;
        }

        if($items) {
            return response()->json([
                'data' => $items
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }
    }
}
