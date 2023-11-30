<?php

namespace App\Models;

use App\Http\Libraries\Datagrid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRoom extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaction_room';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id_room');
    }
    public static function getData($input)
    {
        $table = 'transaction_rooms as tr';
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
