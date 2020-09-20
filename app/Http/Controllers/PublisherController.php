<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function list()
    {
        $publishers = Publisher::getAllPublishers();
        return response()->json($publishers);
    }
}
