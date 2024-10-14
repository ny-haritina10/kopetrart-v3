<?php

namespace App\Models\Cost;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class CostCenterShared extends Model
{
    use HasFactory;
    protected $table = 'v_l_cost_center_active_shared';

    public static function list()
    {
        $data = CostCenterShared::all();
        $result = [
            'data' => [],
            'total' => [
                'direct' => 0,
                'shared' => [],
                'total' => 0
            ]
        ];

        foreach($data as &$row)
        {
            if(isset($result['data'][$row->id]))
            { $object = $result['data'][$row->id]; }
            else
            {
                $object = new stdClass();
                $object->id = $row->id;
                $object->label = $row->label;
                $object->price = $row->price;
                $object->price_total = $row->price;
                $object->share = [];
                $result['data'][$row->id] = $object;

                $result['total']['direct'] += $row->price;
                $result['total']['total'] += $row->price;
            }

            $object_share = new stdClass();
            $object_share->id = $row->id_shared;
            $object_share->label = $row->label_shared;
            $object_share->price = $row->price_shared;
            $object_share->key = $row->key;
            $object->price_total += $object_share->price;

            $result['total']['shared'][$row->id_shared] = ($result['total']['shared'][$row->id_shared] ?? 0) + $row->price_shared;
            $result['total']['total'] += $row->price_shared;

            $object->share[$row->id_shared] = $object_share;
        }

        return $result;
    }
}
