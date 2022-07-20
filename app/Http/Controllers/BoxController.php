<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoxRequest;
use App\Http\Requests\UpdateBoxRequest;
use App\Models\Box;

class BoxController extends Controller
{

    public function showDetail(Box $box)
    {
        $prices = $box->prices()->orderByDesc('price')->get();
        $box->interact('view');
        return view('detail', [
            'box' => $box,
            'prices' => $prices
        ]);
    }
}
