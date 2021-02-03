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
    public function showCart()
    {
        $user_id = Auth::id();
        $data['my_carts'] = $this->where('user_id', $user_id)->get();

        $data['count'] = 0;
        $data['sum'] = 0;

        foreach ($data['my_carts'] as $my_cart) {
            $data['count'] += $my_cart->qty;
            $data['sum'] += $my_cart->stock->fee * $my_cart->qty;
        }

        return $data;
    }

    //カートに商品追加処理
    public function addCart($stock_id, $qty)
    {
        $user_id = Auth::id();
        $cart_add_info = Cart::updateOrCreate(
            [
                'stock_id' => $stock_id,
                'user_id' => $user_id,
            ],
            ['qty' => $qty]
        );

        if ($cart_add_info->wasRecentlyCreated) {
            $message = 'カートに追加しました';
        } else {
            $message = '商品を編集しました';
        }

        return $message;
    }

    //カート内商品削除
    public function deleteCart($stock_id)
    {

        $user_id = Auth::id();
        $delete = $this->where('user_id', $user_id)->where('stock_id', $stock_id)->delete();

        if ($delete > 0) {
            $message = 'カートから一つの商品を削除しました';
        } else {
            $message = '削除に失敗しました';
        }

        return $message;
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
