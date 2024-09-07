<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenelitianRequest;
use App\Http\Resources\PenelitianResource;
use App\Models\Penelitian;
use Illuminate\Http\Request;

class PenelitianController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('s');

        // search using scope search all from penelitian model
        $searchResult = Penelitian::when($search, function ($query, $search) {
            return $query->searchAll($search);
        });

        $penelitians = $searchResult->paginate($perPage);

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => PenelitianResource::collection($penelitians),
            'meta' => [
                'current_page' => $penelitians->currentPage(),
                'last_page' => $penelitians->lastPage(),
                'per_page' => $penelitians->perPage(),
                'total' => $penelitians->total(),
            ],
        ], 200);
    }

    public function store(StorePenelitianRequest $request)
    {
        $validatedData = $request->validated();
        $penelitian = Penelitian::create($validatedData);

        return response()->json([
            'message' => 'Data created successfully',
            'data' => new PenelitianResource($penelitian),
        ], 201);
    }
}
