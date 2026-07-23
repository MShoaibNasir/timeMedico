<?php

namespace App\Repositories;

use App\Models\Area;

class AreaReposatory
{
    public function UpdateBulkPrice(array $data)
    {
        try {

            $query = Area::query();

            if (!empty($data['area_ids'])) {
                // Sirf selected areas update honge
                $query->whereIn('id', $data['area_ids']);
            } else {
                // Koi selection nahi -> sab active areas (purana behavior)
                $query->where('status', 1);
            }

            $query->chunkById(500, function ($items) use ($data) {

                foreach ($items as $item) {

                    if ($data['calcualtion_option'] == 'add') {
                        $item->delivery_charges += $data['price'];
                    } else {
                        $item->delivery_charges -= $data['price'];

                        if ($item->delivery_charges < 0) {
                            $item->delivery_charges = 0;
                        }
                    }

                    $item->save();
                }
            });

            return [
                'success' => true,
                'message' => 'Updated successfully!'
            ];
        } catch (\Exception $e) {

            \Log::error('Area Bulk Price Update Error: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}