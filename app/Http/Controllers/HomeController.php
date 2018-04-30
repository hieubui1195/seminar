<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateSeminarMail;
use App\Models\Seminar;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);
        return $language;
        
        return redirect()->back();
    }

    public function mail()
    {
        $seminarId = 1;
        $userId = 1;

        $email = User::find($userId)->email;
        Mail::to($email)->send(new CreateSeminarMail($userId, $userId));

        return 'Success';
    }
}
