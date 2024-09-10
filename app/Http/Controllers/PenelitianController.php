<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenelitianRequest;
use App\Http\Resources\PaginationMetaResource;
use App\Http\Resources\PenelitianResource;
use App\Models\Penelitian;
use Exception;
use Illuminate\Http\Request;

class PenelitianController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('s');

        try {
            // search using scope search all from penelitian model
            $searchResult = Penelitian::when($search, function ($query, $search) {
                return $query->searchAll($search);
            });

            $penelitians = $searchResult
                // ->with('prodi')
                ->with('penelitian_dosen.dosen')
                ->with('penelitian_mahasiswa.mahasiswa')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PenelitianResource::collection($penelitians),
                'meta' => PaginationMetaResource::meta($penelitians),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(StorePenelitianRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $penelitian = Penelitian::create($validatedData);

            return response()->json([
                'message' => 'Data created successfully',
                'data' => new PenelitianResource($penelitian),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Penelitian $penelitian)
    {
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new PenelitianResource($penelitian),
        ]);
    }

    public function destroy(Penelitian $penelitian)
    {
        $penelitian->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(StorePenelitianRequest $request, Penelitian $penelitian)
    {
        try {
            $validatedData = $request->validated();
            $penelitian->update($validatedData);

            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PenelitianResource($penelitian),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }


}
