<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{    public function switch($lang)
    {
        // Available languages
        $availableLangs = ['en', 'fr', 'ar', 'es'];
        
        // Check if the language is supported
        if (in_array($lang, $availableLangs)) {
            Session::put('locale', $lang);
            App::setLocale($lang);
            
            // Set RTL/LTR
            if ($lang === 'ar') {
                Session::put('dir', 'rtl');
            } else {
                Session::put('dir', 'ltr');
            }
        }
        
        return redirect()->back();
    }
}
