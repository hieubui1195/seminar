<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TwilioRestClient;
use TwilioJwtAccessToken;
use TwilioJwtGrantsVideoGrant;

class VideoRoomsController extends Controller
{
    public function index()
    {

        return view('video');
    }

    public function auth(Request $request)
    {
        $response = [
            'user_id' => $request->userId,
            'user_info' => $request->userInfo,
        ];

        return response()->json($response);
    }
}
