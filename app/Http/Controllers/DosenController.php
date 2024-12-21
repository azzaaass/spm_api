<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenRequest;
use App\Http\Resources\DosenResource;
use App\Http\Resources\PaginationMetaResource;
use App\Models\Dosen;
use Exception;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);

        $searchTable = $request->input('s_table', 'nip');
        $search = $request->input('s');
        $searchLike = filter_var($request->input('s_like', false), FILTER_VALIDATE_BOOLEAN);

        $sortingTable = $request->input('sort_table');
        $sorting = $request->input('sort', 'asc');

        try {
            // searching
            $searchResult = Dosen::when($search, function ($query, $search) use ($searchTable, $searchLike) {
                if ($searchLike) {
                    return $query->where($searchTable, 'like', "%{$search}%");
                }
                return $query->where($searchTable, '=', "{$search}");
            });

            // sorting
            if ($sortingTable) {
                $searchResult->orderBy($sortingTable, $sorting);
            }

            $dosens = $searchResult
                ->with('prodi')
                ->with('history_jabatan.jabatan')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => DosenResource::collection($dosens),
                'meta' => PaginationMetaResource::meta($dosens),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(DosenRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $dosen = Dosen::create($validatedData);

            return response()->json([
                'message' => 'Data created successfully',
                'data' => new DosenResource($dosen),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Dosen $dosen)
    {
        $dosen->load('prodi');

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new DosenResource($dosen),
        ]);
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function update(DosenRequest $request, Dosen $dosen)
    {
        try {
            $validatedData = $request->validated();
            $dosen->update($validatedData);

            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new DosenResource($dosen),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
