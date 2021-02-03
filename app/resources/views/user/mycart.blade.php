@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
                {{ Auth::user()->name }}さんのカートの中身</h1>

            <div class="card-body">
                <p class="text-center">{{ $message ?? '' }}</p><br>
                <div class="flex-row flex-wrap">

                    @if($my_carts->isNotEmpty())

                    @foreach($my_carts as $my_cart)
                    <div class="mycart_box">
                        {{$my_cart->stock->name}} <br>
                        個数：{{ $my_cart->qty }}個 <br>
                        {{ number_format($my_cart->stock->fee)}}円 <br>
                        <img src="{{ asset('/uploads/' . $my_cart->stock->imgpath) }}" alt="" class="incart">
                        <br>
                        <a href="{{ route('detail', ['id' => $my_cart->stock->id ]) }}">商品の編集</a>

                        <form action="{{ route('deletecart') }}" method="post">
                            @csrf
                            <input type="hidden" name="delete" value="delete">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="stock_id" value="{{ $my_cart->stock->id }}">
                            <input type="submit" class="btn btn-primary btn-sm text-center delete-btn" value=" カートから削除する">
                        </form>
                    </div>
                    @endforeach

                    <div class="text-center p-2">
                        個数：{{ $count }}個 <br>
                        <p style="font-size: 1.2em; font-weight: bold;">合計：{{ number_format($sum) }}</p>
                    </div>
                    <form action="/checkout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg text-center buy-btn">購入する</button>
                    </form>

                    @else
                    <p class="text-center">カートは空っぽです</p>
                    @endif

                    <a href="/">商品一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection