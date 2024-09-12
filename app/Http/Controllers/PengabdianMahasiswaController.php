<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengabdianMahasiswaRequest;
use App\Http\Resources\PengabdianMahasiswaResource;
use App\Models\PengabdianMahasiswa;
use Exception;
use Illuminate\Http\Request;

class PengabdianMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $searchTable = $request->input('s_table', 'id_pengabdian');
        $search = $request->input('s');

        $sortingTable = $request->input('sort_table');
        $sorting = $request->input('sort', 'asc');

        try {
            // searching
            $searchResult = PengabdianMahasiswa::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $pengabdianMahasiswa = $searchResult
                ->with('mahasiswa.prodi')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PengabdianMahasiswaResource::collection($pengabdianMahasiswa)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(PengabdianMahasiswaRequest $request)
    {
        try {
            $validateData = $request->validated();
            $pengabdianMahasiswa = PengabdianMahasiswa::create($validateData);
            return response()->json([
                'message' => 'Data created successfully',
                'data' => new PengabdianMahasiswaResource($pengabdianMahasiswa),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(PengabdianMahasiswa $pengabdianMahasiswa)
    {
        return response()->json([
            'message' => 'Data ertried successfully',
            'data' => new PengabdianMahasiswaResource($pengabdianMahasiswa),
        ], 200);
    }

    public function destroy(PengabdianMahasiswa $pengabdianMahasiswa)
    {
        $pengabdianMahasiswa->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(PengabdianMahasiswaRequest $request, PengabdianMahasiswa $pengabdianMahasiswa)
    {
        try {
            $validateData = $request->validated();
            $pengabdianMahasiswa->update($validateData);
            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PengabdianMahasiswaResource($pengabdianMahasiswa),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
