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
            // Inisialisasi query builder
            $query = Prestasi::query();

            // searching
            if (!$searchTable) {
                // search using scope search all from prestasi model
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
                    $query->when($search, function ($query, $search) use ($searchTable) {
                        return $query->where($searchTable, '=', "{$search}");
                    });
                }
            }


            // sorting
            if ($sortingTable) {
                $query->orderBy($sortingTable, $sorting);
            }

            $prestasis = $query
                // ->with('prestasi_dosen.dosen')
                ->with('prestasi_mahasiswa.mahasiswa')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PrestasiResource::collection($prestasis),
                'meta' => PaginationMetaResource::meta($prestasis),
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
            $prestasi = Prestasi::create($validatedData);

            return response()->json([
                'message' => 'Data created successfully',
                'data' => new PrestasiResource($prestasi),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Prestasi $prestasi)
    {
        $prestasi->load('prestasi_mahasiswa.mahasiswa.prodi');

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new PrestasiResource($prestasi),
        ]);
    }

    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        try {
            $validatedData = $request->validated();
            $prestasi->update($validatedData);

            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PrestasiResource($prestasi),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

}
