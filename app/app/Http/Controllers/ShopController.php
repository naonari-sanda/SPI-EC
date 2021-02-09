<?php

namespace App\Http\Controllers;


use Session;
use App\Mail\Thanks;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\History;
use App\Models\Acount;
use App\Http\Requests\AcountRequest;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Console\Presets\React;

class ShopController extends Controller
{

    public function index()
    {
        // $stocks = Stock::Paginate(6);
        return Stock::all();
    }

    public function detail(int $id)
    {
        $stock = Stock::find($id);

        return $stock;
    }

    //カートページ
    public function myCart(int $id, Cart $cart)
    {
        $user_id = $id;
        return $data = $cart->showCart($user_id);
    }

    //カートに商品を追加・編集：カートページ表示
    public function addMycart(CartRequest $request)
    {
        Cart::updateOrCreate(
            [
                'stock_id' =>  $request->stock_id,
                'user_id' => $request->user_id
            ],
            ['qty' => $request->qty]
        );
    }

    //商品をカートから削除：カートページ表示
    public function deleteCart(Request $request)
    {
        $data = Cart::where('user_id', $request->user_id)->where('stock_id', $request->stock_id)->delete();

        return $data;
    }

    //注文受付完了
    public function checkout(Request $request, Cart $cart, History $history)
    {
        $user = Auth::user();

        $items = Cart::where('user_id', $user->id)->get();
        $history->addhistory($items);


        $mail_data['user'] = $user->name;
        $mail_data['checkout_items'] = $cart->checkoutCart();

        if (!empty($mail_data['checkout_items'])) {
            $message = '注文を受付ました';
        } else {
            $message = '注文は失敗しました';
        }

        Session::flash('flash_message', $message);


        Mail::to($user->email)->send(new Thanks($mail_data));

        return view('user.checkout');
    }
}
