<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengabdianDosenRequest;
use App\Http\Resources\PengabdianDosenResource;
use App\Models\PengabdianDosen;
use Exception;
use Illuminate\Http\Request;

class PengabdianDosenController extends Controller
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
            $searchResult = PengabdianDosen::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $pengabdianDosen = $searchResult
                ->with('dosen.prodi')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PengabdianDosenResource::collection($pengabdianDosen)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(PengabdianDosenRequest $request)
    {
        $validateData = $request->validated();
        $pengabdianDosen = PengabdianDosen::create($validateData);

        return response()->json([
            'message' => 'Data created successfully',
            'data' => new PengabdianDosenResource($pengabdianDosen),
        ], 201);
    }

    public function show(PengabdianDosen $pengabdianDosen)
    {
        return response()->json([
            'message' => 'Data ertried successfully',
            'data' => new PengabdianDosenResource($pengabdianDosen),
        ], 200);
    }

    public function destroy(PengabdianDosen $pengabdianDosen)
    {
        $pengabdianDosen->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(PengabdianDosenRequest $request, PengabdianDosen $pengabdianDosen)
    {
        try {
            $validateData = $request->validated();
            $pengabdianDosen->update($validateData);
            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PengabdianDosenResource($pengabdianDosen),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}