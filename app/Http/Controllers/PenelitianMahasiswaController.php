<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenelitianMahasiswaRequest;
use App\Http\Resources\PaginationMetaResource;
use App\Http\Resources\PenelitianMahasiswaResource;
use App\Models\PenelitianMahasiswa;
use Exception;
use Illuminate\Http\Request;

class PenelitianMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $searchTable = $request->input('s_table', 'id_penelitian');
        $search = $request->input('s');

        $sortingTable = $request->input('sort_table');
        $sorting = $request->input('sort', 'asc');

        try {
            // searching
            $searchResult = PenelitianMahasiswa::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $penelitianMahasiswa = $searchResult
                ->with('mahasiswa.prodi')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PenelitianMahasiswaResource::collection($penelitianMahasiswa),
                'meta' => PaginationMetaResource::meta($penelitianMahasiswa),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(PenelitianMahasiswaRequest $request)
    {
        try {
            $validateData = $request->validated();
            $penelitianMahasiswa = PenelitianMahasiswa::create($validateData);
            return response()->json([
                'message' => 'Data created successfully',
                'data' => new PenelitianMahasiswaResource($penelitianMahasiswa),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(PenelitianMahasiswa $penelitianMahasiswa)
    {
        return response()->json([
            'message' => 'Data ertried successfully',
            'data' => new PenelitianMahasiswaResource($penelitianMahasiswa),
        ], 200);
    }

    public function destroy(PenelitianMahasiswa $penelitianMahasiswa)
    {
        $penelitianMahasiswa->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(PenelitianMahasiswaRequest $request, PenelitianMahasiswa $penelitianMahasiswa)
    {
        try {
            $validateData = $request->validated();
            $penelitianMahasiswa->update($validateData);
            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PenelitianMahasiswaResource($penelitianMahasiswa),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
