<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class Updateyear extends Controller
{

    public function year(Request $request)
    {
        session(['year' => $request->input('year')]);
    
        return redirect()->back();
}


}