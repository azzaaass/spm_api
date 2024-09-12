<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Http\Resources\PaginationMetaResource;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);

        $searchTable = $request->input('s_table', 'nip');
        $search = $request->input('s');

        $sortingTable = $request->input('sort_table');
        $sorting = $request->input('sort', 'asc');

        try {
            // searching
            $searchResult = Mahasiswa::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $mahasiswas = $searchResult
                ->with('prodi')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => MahasiswaResource::collection($mahasiswas),
                'meta' => PaginationMetaResource::meta($mahasiswas),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(MahasiswaRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $mahasiswa = Mahasiswa::create($validatedData);

            return response()->json([
                'message' => 'Data created successfully',
                'data' => new MahasiswaResource($mahasiswa),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi');

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new MahasiswaResource($mahasiswa),
        ]);
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        try {
            $validatedData = $request->validated();
            $mahasiswa->update($validatedData);

            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new MahasiswaResource($mahasiswa),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
