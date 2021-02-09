<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $guarded = [
        'id'
    ];

    //リレーション
    public function stock()
    {
        return $this->belongsTo('\App\Models\stock');
    }

    //合計・個数処理
    public function showCart($user_id)
    {
        $data['my_carts'] = $this->where('user_id', $user_id)->get();

        $data['count'] = 0;
        $data['sum'] = 0;

        foreach ($data['my_carts'] as $my_cart) {
            $data['count'] += $my_cart->qty;
            $data['sum'] += $my_cart->stock->fee * $my_cart->qty;
        }

        return $data;
    }

    //注文完了：カート内削除
    public function CheckoutCart()
    {
        $user_id = Auth::id();

        $checkout_items = $this->where('user_id', $user_id)->get();

        $this->where('user_id', $user_id)->delete();

        return $checkout_items;
    }

    //商品を削除時、同じカート内商品も削除
    public function deleteWithCart($stock_id)
    {
        $this->where('stock_id', $stock_id)->delete();
    }
}
