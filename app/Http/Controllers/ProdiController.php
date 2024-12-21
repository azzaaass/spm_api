<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdiRequest;
use App\Http\Resources\PaginationMetaResource;
use App\Http\Resources\ProdiResource;
use App\Models\Prodi;
use Exception;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);

        $searchTable = $request->input('s_table', 'id');
        $search = $request->input('s');
        $searchLike = filter_var($request->input('s_like', false), FILTER_VALIDATE_BOOLEAN);


        try {
            // searching
            $searchResult = Prodi::when($search, function ($query, $search) use ($searchTable, $searchLike) {
                if ($searchLike) {
                    return $query->where($searchTable, 'like', "%{$search}%");
                }
                return $query->where($searchTable, '=', "{$search}");
            });

            $prodis = $searchResult->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => ProdiResource::collection($prodis),
                'meta' => PaginationMetaResource::meta($prodis)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(Prodi $prodi)
    {
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => new ProdiResource($prodi),
        ], 200);
    }

    public function store(ProdiRequest $request)
    {
        try {
            $request->validated();
            $prodi = Prodi::create($request->all());
            return response()->json([
                'message' => 'Data created successfully',
                'data' => new ProdiResource($prodi),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(ProdiRequest $request, Prodi $prodi)
    {
        try {
            $request->validated();
            $prodi->update($request->all());
            return response()->json([
                'message' => 'Data updated successfully',
                'data' => new ProdiResource($prodi),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(Prodi $prodi)
    {
        try {
            $prodi->delete();
            return response()->json([
                'message' => 'Data deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
