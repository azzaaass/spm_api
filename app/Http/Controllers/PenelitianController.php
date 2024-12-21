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

        $searchTable = $request->input('s_table');
        $search = $request->input('s');

        $sortingTable = $request->input('sort_table');
        $sorting = $request->input('sort', 'asc');

        try {
            // Inisialisasi query builder
            $query = Penelitian::query();

            // Searching
            if (!$searchTable) {
                // search using scope search all from penelitian model
                $query->when($search, function ($query, $search) {
                    return $query->searchAll($search);
                });
            } else {
                if ($searchTable === "ketua_prodi") {
                    // by prodi ketua
                    $query->searchKetua("id_prodi", "=", $search);
                } else if ($searchTable === "ketua_name") {
                    // by name ketua
                    $query->searchKetua("name", "LIKE", "%{$search}%");
                } else {
                    $query->where($searchTable, '=', "{$search}");
                }
            }


            // Sorting
            if ($sortingTable) {
                $query->orderBy($sortingTable, $sorting);
            }

            // Eager load relasi dan paginasi
            $penelitians = $query
                ->with('penelitian_dosen.dosen')
                ->with('penelitian_mahasiswa.mahasiswa')
                ->paginate($perPage);

            // Response
            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PenelitianResource::collection($penelitians),
                'meta' => PaginationMetaResource::meta($penelitians),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage(),
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
        $penelitian->load('penelitian_dosen.dosen.prodi')
            ->load('penelitian_mahasiswa.mahasiswa.prodi');

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
