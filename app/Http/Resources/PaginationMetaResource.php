<?php

namespace App\Http\Resources;

class PaginationMetaResource
{
    public static function meta($pagination)
    {
        return [
            'current_page' => $pagination->currentPage(),
            'last_page' => $pagination->lastPage(),
            'per_page' => $pagination->perPage(),
            'total' => $pagination->total(),
        ];
    }
}