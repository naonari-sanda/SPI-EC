<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Cart;
use App\Models\Stock;
use App\Http\Requests\CreateRequest;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //メイン管理画面
    public function admin()
    {
        $stocks = Stock::Paginate(6);
        return view('/admin/shop', compact('stocks'));
    }

    public function detail(int $id, Stock $stock)
    {
        $stock = Stock::find($id);

        return view('admin.detail', compact('stock'));
    }

    public function delete(Request $request, Stock $stock, Cart $cart)
    {
        $stock_id = $request->stock_id;

        $message = $stock->deleteStock($stock_id);

        Session::flash('flash_message', $$message);

        $cart->deleteWithCart($stock_id);

        return redirect()->route('admin.main');
    }



    public function edit(Request $request, Stock $stock)
    {

        $stock_id = $request->id;

        $stock = $stock->detail($stock_id);

        return view('admin.edit', compact('stock'));
    }

    public function update(CreateRequest $request, Stock $stock)
    {

        $item = Stock::find($request->stock_id);

        $item->name  = $request->name;
        $item->detail  = $request->detail;
        $item->fee  = $request->fee;


        if ($file = $request->imgpath) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }

        $item->imgpath = $fileName;
        $item->save();


        if ($item->save()) {
            session()->flash('flash_message', '商品をアップデートしました');
        } else {
            session()->flash('flash_message', '商品を追加できませんでした');
        }


        return view('admin.detail', ['stock' => $item]);
    }

    public function add()
    {
        return view('admin.add');
    }

    public function confirm(CreateRequest $request)
    {

        if ($file = $request->file('imgpath')) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }

        $request->imgpath = $fileName;

        return view('admin.confirm', compact('request'));
    }

    public function create(Request $request)
    {
        $stock = new stock;
        $form = $request->all();
        unset($form['_token']);
        $stock->fill($form)->save();

        if ($stock->save()) {
            session()->flash('flash_message', '商品を追加しました');
        } else {
            session()->flash('flash_message', '商品を追加できませんでした');
        }

        return redirect()->route('admin.main');
    }
}
