<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestasiRequest;
use App\Http\Resources\PaginationMetaResource;
use App\Http\Resources\PrestasiResource;
use App\Models\Prestasi;
use Exception;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);

        $searchTable = $request->input('s_table');
        $search = $request->input('s');

        $sortingTable = $request->input('sort_table');
        $sorting = $request->input('sort', 'asc');

        try {
            // searching
            (!$searchTable) ?
                // search using scope search all from penelitian model
                $searchResult = Prestasi::when($search, function ($query, $search) {
                    return $query->searchAll($search);
                })
                :
                $searchResult = Prestasi::when($search, function ($query, $search) use ($searchTable) {
                    return $query->where($searchTable, '=', "{$search}");
                });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $penelitians = $searchResult
                // ->with('penelitian_dosen.dosen')
                // ->with('penelitian_mahasiswa.mahasiswa')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PrestasiResource::collection($penelitians),
                'meta' => PaginationMetaResource::meta($penelitians),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(PrestasiRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $penelitian = Prestasi::create($validatedData);

            return response()->json([
                'message' => 'Data created successfully',
                'data' => new PrestasiResource($penelitian),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Prestasi $penelitian)
    {
        $penelitian->load('penelitian_mahasiswa.mahasiswa.prodi');

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new PrestasiResource($penelitian),
        ]);
    }

    public function destroy(Prestasi $penelitian)
    {
        $penelitian->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(PrestasiRequest $request, Prestasi $penelitian)
    {
        try {
            $validatedData = $request->validated();
            $penelitian->update($validatedData);

            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PrestasiResource($penelitian),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

}
