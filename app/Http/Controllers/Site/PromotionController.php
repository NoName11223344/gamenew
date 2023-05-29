<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function __construct()
    {
    }

    public function showPromotionActive(){
        $promotions = Promotion::where('status', 1)->paginate(10);

        return view('site.promotions')->with([
            'promotions' => $promotions
        ]);
    }
}
