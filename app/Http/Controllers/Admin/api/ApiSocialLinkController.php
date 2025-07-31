<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Models\Social_link;
use Illuminate\Http\Request;

class ApiSocialLinkController extends Controller
{
    public function index()
    {
        return response()->json(Social_link::all(), 200);
    }

}
