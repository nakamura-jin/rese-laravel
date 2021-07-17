<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        $items = Area::all();
        return response()->json([
            'data' => $items
        ], 200);
    }
}
