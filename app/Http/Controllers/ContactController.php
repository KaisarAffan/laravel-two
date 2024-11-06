<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('contact',
        ['title'=> 'contact',
                'name'=> 'kaisar affan danendra',
                'class'=>'11 PPLG 2',
                'linkedin'=> 'https://www.linkedin.com/in/kaisar-affan-bb8a90293/',
                'porto'=> 'https://github.com/KaisarAffan/grab_login-and-register-ui',
    ]);
    }
}
