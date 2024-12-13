<?php

namespace App\Http\Controllers;

use App\Http\Resources\JabatanResource;
use App\Http\Resources\PaginationMetaResource;
use App\Models\Jabatan;
use Exception;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);

        $searchTable = $request->input('s_table', 'id');
        $search = $request->input('s');

        try {
            // searching
            $searchResult = Jabatan::when($search, function ($query, $search) use ($searchTable) {
                return $query->where($searchTable, '=', "{$search}");
            });

            $jabatans = $searchResult->paginate($perPage);

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => JabatanResource::collection($jabatans),
                'meta' => PaginationMetaResource::meta($jabatans)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data not found',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
