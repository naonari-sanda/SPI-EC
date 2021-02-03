@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 class="text-center font-weight-bold" style="color:#fff;  font-size:1.2em; padding:24px 0px;">
                商品ページ</h1>

            <h2>{{ $message ?? '' }}</h2>

            <div class="card-body">
                <div class="flex-row flex-wrap">

                    @if(isset( $stock ))

                    <div class="mycart_box">
                        {{ $stock->name}} <br>
                        {{ number_format($stock->fee)}}円 <br>
                        <img src="{{ asset('/uploads/' . $stock->imgpath) }}" alt="" class="incart img-thumbnail ">
                        <br>
                        <p>{{ $stock->detail }}</p>

                        <a class="mb-5px" href="{{ route('admin.edit', ['id' => $stock->id]) }}">編集はこちら</a><br>

                        <form action="{{ route('admin.delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="delete" value="delete">
                            <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                            <input type="submit" class="btn btn-danger btn-lg text-center buy-btn" value="商品を削除する">
                        </form><br>



                    </div>
                    @endif

                    <a href="{{ route('admin.main') }}">商品一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection