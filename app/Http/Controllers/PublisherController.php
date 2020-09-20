<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\JsonResponse;

class PublisherController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list()
    {
        $publishers = Publisher::getAllPublishers();
        return response()->json($publishers);
    }
}
