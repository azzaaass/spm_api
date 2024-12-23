<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengabdianRequest;
use App\Http\Resources\PaginationMetaResource;
use App\Http\Resources\PengabdianResource;
use App\Models\Pengabdian;
use Exception;
use Illuminate\Http\Request;

class PengabdianController extends Controller
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
            $query = Pengabdian::query();

            // searching
            if (!$searchTable) {
                // search using scope search all from pengabdian model
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

            // sorting
            if ($sortingTable) {
                $query->orderBy($sortingTable, $sorting);
            }

            $pengabdians = $query
                ->with('pengabdian_dosen.dosen')
                ->with('pengabdian_mahasiswa.mahasiswa')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PengabdianResource::collection($pengabdians),
                'meta' => PaginationMetaResource::meta($pengabdians),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(PengabdianRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $pengabdian = Pengabdian::create($validatedData);

            return response()->json([
                'message' => 'Data created successfully',
                'data' => new PengabdianResource($pengabdian),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Pengabdian $pengabdian)
    {
        $pengabdian->load('pengabdian_dosen.dosen.prodi')
            ->load('pengabdian_mahasiswa.mahasiswa.prodi');

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new PengabdianResource($pengabdian),
        ]);
    }

    public function destroy(Pengabdian $pengabdian)
    {
        $pengabdian->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(PengabdianRequest $request, Pengabdian $pengabdian)
    {
        try {
            $validatedData = $request->validated();
            $pengabdian->update($validatedData);

            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PengabdianResource($pengabdian),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
