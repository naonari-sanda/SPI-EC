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
    //メイン画面
    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('user.shop', compact('stocks'));
    }

    //商品詳細表示
    public function detail(int $id)
    {
        $stock = Stock::find($id);

        return view('user.detail', compact('stock'));
    }

    //カートページ
    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();

        return view('user.mycart', $data);
    }

    //カートに商品を追加・編集：カートページ表示
    public function addMycart(CartRequest $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $qty = $request->qty;
        $message = $cart->addCart($stock_id, $qty);

        Session::flash('flash_message', $message);

        return redirect()->route('mycart');
    }

    //商品をカートから削除：カートページ表示
    public function deleteCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);

        $data = $cart->showCart();

        Session::flash('flash_message', $message);

        return view('user.mycart', $data);
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
