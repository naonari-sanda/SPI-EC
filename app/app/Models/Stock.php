<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    protected $guarded = [
        'id'
    ];

    public function detail($stock_id)
    {
        $detail = $this->where('id', $stock_id)->first();

        return $detail;
    }


    public function deleteStock($stock_id)
    {
        $delete = $this->where('id', $stock_id)->delete();


        if ($delete > 0) {
            $message = '商品を削除しました';
        } else {
            $message = '商品を削除できませんでした';
        }

        return $message;
    }
}
