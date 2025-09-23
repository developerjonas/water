<?php

namespace App\Actions\Import;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class IndexClass
{
    public function fromCsv(string $path, callable $mapRow, array $rules = []): Collection
    {
        $rows = collect(array_map('str_getcsv', file($path)));

        // Assume first row = headers
        $headers = $rows->shift();

        return $rows->map(function ($row) use ($headers, $mapRow, $rules) {
            $data = array_combine($headers, $row);

            if (!empty($rules)) {
                Validator::make($data, $rules)->validate();
            }

            return $mapRow($data);
        });
    }
}
