<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class ItemsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['item'])) {
                continue;
            }
            $dummyImage = 'images/dummy.png';
            $exists = Item::where([
                'name'      => $row['item'],
                'quantity'  => $row['quantity'] ?? 0,
                'location'  => $row['storage_location'] ?? null,
                'shelf'     => $row['shelf_number'] ?? null,
                'row'       => $row['row_number'] ?? null,
                'category'  => $row['category'] ?? null,
                'image'     => $dummyImage,
                'status'    => 0,
                'user_id'   => auth()->id() ?? null,
                'venue_id'  => null,
            ])->exists();

            if (! $exists) {
                Item::create([
                    'name' => $row['item'],
                    'quantity' => $row['quantity'] ?? 0,
                    'location' => $row['storage_location'] ?? null,
                    'shelf' => $row['shelf_number'] ?? null,
                    'row' => $row['row_number'] ?? null,
                    'category' => $row['category'] ?? null,
                    'image' => $dummyImage,
                    'status' => 0,
                    'user_id' => auth()->id() ?? null,
                    'venue_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
