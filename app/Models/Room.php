<?php

namespace App\Models;

use App\Http\Libraries\Datagrid;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, Sluggable;
    protected $primaryKey = 'id_room';
    public function sluggable(): array
    {
        return [
            'slug_room' => [
                'source' => 'name_room'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category_room()
    {
        return $this->belongsTo(CategoryRoom::class, 'category_room_id', 'id_category_room');
    }
    public static function getData($input)
    {
        $table = 'rooms as cr';
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
