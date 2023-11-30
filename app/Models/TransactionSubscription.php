<?php

namespace App\Models;

use App\Http\Libraries\Datagrid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionSubscription extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaction_subscription';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public static function getData($input)
    {
        $table = 'transaction_subscriptions as ts';
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
