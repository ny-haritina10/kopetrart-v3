<?php

namespace App\Models\Cost;

use App\Models\Misc\Nature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class CostCenterDetail extends Model
{
    use HasFactory;

    protected $table = 'v_l_cost_center_detail';

    public static function list()
    {
        $data = CostCenterDetail::all();
        $natures = Nature::all();
        $result = [];

        foreach($data as &$row)
        {
            if(isset($result[$row->id_expense]))
            { $object = $result[$row->id_expense]; }
            else
            {
                $object = new stdClass();
                $object->id_expense = $row->id_expense;
                $object->label = $row->label;
                $object->unit = $row->unit;
                $object->nature = $row->nature;
                $object->incorporation = $row->incorporation;
                $object->quantity = $row->quantity;
                $object->price_total = $row->price_total;
                $object->data = $row->data;
                $object->details = ['total' => []];
                foreach ($natures as &$nature)
                { $object->details['total'][$nature->label] = $row->id_nature == $nature->id ? $row->price_total: 0; }

                $result[$row->id_expense] = $object;
            }

            $object->details[$row->center] = [
                'percentage' => $row->percentage,
            ];
            foreach ($natures as &$nature)
            { $object->details[$row->center][$nature->label] = $row->id_nature == $nature->id ? $row->price_center: 0; }
        }

        return $result;
    }
}
