<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestasiMahasiswaRequest;
use App\Http\Resources\PrestasiMahasiswaResource;
use App\Models\PrestasiMahasiswa;
use Exception;
use Illuminate\Http\Request;

class PrestasiMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $searchTable = $request->input('s_table', 'id');
        $search = $request->input('s');

        $sortingTable = $request->input('sort_table');
        $sorting = $request->input('sort', 'asc');

        try {
            // searching
            $searchResult = PrestasiMahasiswa::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $prestasiMahasiswa = $searchResult
                // ->with('mahasiswa.prodi')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PrestasiMahasiswaResource::collection($prestasiMahasiswa)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(PrestasiMahasiswaRequest $request)
    {
        try {
            $validateData = $request->validated();
            $prestasiMahasiswa = PrestasiMahasiswa::create($validateData);
            return response()->json([
                'message' => 'Data created successfully',
                'data' => new PrestasiMahasiswaResource($prestasiMahasiswa),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(PrestasiMahasiswa $prestasiMahasiswa)
    {
        return response()->json([
            'message' => 'Data ertried successfully',
            'data' => new PrestasiMahasiswaResource($prestasiMahasiswa),
        ], 200);
    }

    public function destroy(PrestasiMahasiswa $prestasiMahasiswa)
    {
        $prestasiMahasiswa->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(PrestasiMahasiswaRequest $request, PrestasiMahasiswa $prestasiMahasiswa)
    {
        try {
            $validateData = $request->validated();
            $prestasiMahasiswa->update($validateData);
            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PrestasiMahasiswaResource($prestasiMahasiswa),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
