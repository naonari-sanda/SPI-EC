<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    protected $guarded = [
        'id'
    ];

    //リレーション
    public function Stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }

    public function getHistory($id)
    {
        $lists = $this->where('user_id', $id)->orderBy('id', 'desc')->get();

        return $lists;
    }

    //購入商品を履歴として追加
    public function addHistory($items)
    {
        $user_id = Auth::id();

        foreach ($items as $item) {
            $this->create([
                'user_id' => $user_id,
                'stock_id' => $item->stock_id,
                'qty' => $item->qty,
                'name' => $item->stock->name,
                'detail' => $item->stock->detail,
                'fee' => $item->stock->fee,
                "imgpath" => $item->stock->imgpath
            ]);
        }
    }
}
