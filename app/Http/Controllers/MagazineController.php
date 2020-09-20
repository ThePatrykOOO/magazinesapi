<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagazineSearchRequest;
use App\Http\Resources\MagazineResource;
use App\Magazine;
use Illuminate\Http\JsonResponse;

class MagazineController extends Controller
{
    /**
     * @param MagazineSearchRequest $request
     * @return JsonResponse
     */
    public function search(MagazineSearchRequest $request)
    {
        $magazines = Magazine::findAndPaginateMagazines($request->validated());
        return response()->json($magazines);
    }

    /**
     * @param Magazine $magazine
     * @return MagazineResource
     */
    public function show(Magazine $magazine)
    {
        return new MagazineResource($magazine);
    }
}
