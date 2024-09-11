<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryJabatanRequest;
use App\Http\Resources\HistoryJabatanResource;
use App\Http\Resources\PaginationMetaResource;
use App\Models\HistoryJabatan;
use Exception;
use Illuminate\Http\Request;

class HistoryJabatanController extends Controller
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
            $searchResult = HistoryJabatan::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $dosens = $searchResult
                ->with('jabatan')
                ->with('dosen')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => HistoryJabatanResource::collection($dosens),
                'meta' => PaginationMetaResource::meta($dosens),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(HistoryJabatanRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $historyJabatan = HistoryJabatan::create($validatedData);

            return response()->json([
                'message' => 'Data created successfully',
                'data' => new HistoryJabatanResource($historyJabatan),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(HistoryJabatan $historyJabatan)
    {
        $historyJabatan->load('jabatan', 'dosen');

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new HistoryJabatanResource($historyJabatan),
        ]);
    }

    public function destroy(HistoryJabatan $historyJabatan)
    {
        $historyJabatan->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(HistoryJabatanRequest $request, HistoryJabatan $historyJabatan)
    {
        try {
            $validatedData = $request->validated();
            $historyJabatan->update($validatedData);

            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new HistoryJabatanResource($historyJabatan),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
