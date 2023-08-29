<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;



class PrivacyPolicyController extends Controller
{

    public function privacy()
    {
        return view('privacy_polcy');

}
public function description()
{
    return view('description');


}

}