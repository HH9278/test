<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FmobjController extends Controller
{
    /**
     * 動画一覧を表示する
     * 
     * @return view
     */
    public function showList()
    {
        return view('fmobj.list');
    }
}
