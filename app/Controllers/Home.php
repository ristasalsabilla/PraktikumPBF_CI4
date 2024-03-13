<?php

namespace App\Controllers;

//controllers
class Home extends BaseController
{
    // method
    public function index(): string
    {
        // mengembalikan sebuah view
        // CI akan memanggil sebuah file welcome_message.php didalam folder View
        return view('welcome_message');
        //echo "Hello World";
    }
}
