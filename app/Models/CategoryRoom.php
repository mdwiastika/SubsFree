<?php

namespace App\Models;

use App\Http\Libraries\Datagrid;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRoom extends Model
{
    use HasFactory, Sluggable;
    protected $primaryKey = 'id_category_room';
    public function sluggable(): array
    {
        return [
            'slug_category_room' => [
                'source' => 'name_category_room'
            ]
        ];
    }
    public static function getData($input)
    {
        $table = 'category_rooms as cr';
        $select = '*';

        $replace_field  = [
            // ['old_name' => 'subLevel', 'new_name' => 'sub_level'],
        ];

        $param = [
            'input' => $input->all(),
            'select' => $select,
            'table' => $table,
            'replace_field' => $replace_field,
        ];

        $datagrid = new Datagrid;
        $data = $datagrid->datagrid_query($param, function ($data) {
            return $data;
        });

        return $data;
    }
}
