<?php

namespace App\Controllers;

//controllers
class Test extends BaseController
{
    // method
    public function index(): string
    {   
        return view('test');
    }
}
