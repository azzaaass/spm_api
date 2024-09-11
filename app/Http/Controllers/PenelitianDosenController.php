<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenelitianDosenRequest;
use App\Http\Resources\PenelitianDosenResource;
use App\Models\PenelitianDosen;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PenelitianDosenController extends Controller
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
            $searchResult = PenelitianDosen::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $penelitianDosen = $searchResult
                ->with('dosen.prodi')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => PenelitianDosenResource::collection($penelitianDosen)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(StorePenelitianDosenRequest $request)
    {
        $validateData = $request->validated();
        $penelitianDosen = PenelitianDosen::create($validateData);

        return response()->json([
            'message' => 'Data created successfully',
            'data' => new PenelitianDosenResource($penelitianDosen),
        ], 201);
    }

    public function show(PenelitianDosen $penelitianDosen)
    {
        return response()->json([
            'message' => 'Data ertried successfully',
            'data' => new PenelitianDosenResource($penelitianDosen),
        ], 200);
    }

    public function destroy(PenelitianDosen $penelitianDosen)
    {
        $penelitianDosen->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(StorePenelitianDosenRequest $request, PenelitianDosen $penelitianDosen)
    {
        try {
            $validateData = $request->validated();
            $penelitianDosen->update($validateData);
            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new PenelitianDosenResource($penelitianDosen),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}