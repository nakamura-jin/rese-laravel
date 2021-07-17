<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
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
}
