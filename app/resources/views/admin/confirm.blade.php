@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 class="text-center font-weight-bold" style="color:#fff;  font-size:1.2em; padding:24px 0px;">
                {{ Auth::user()->name }}管理者ページ</h1>

            <div class="card-body">
                <p class="text-center" style="color: #fff;">商品を追加してもよろしいですか？</p><br>
                <div class="flex-row flex-wrap">


                    <div class="mycart_box">
                        {{ $request->name}} <br>
                        {{ number_format($request->fee)}}円 <br>
                        <img src="{{ asset('/uploads/' . $request->imgpath) }}" alt="" class="incart">
                        <br>
                        {{ $request->detail }}

                        <form action="{{ route('admin.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="name" value="{{ $request->name }}">
                            <input type="hidden" name="detail" value="{{ $request->detail }}">
                            <input type="hidden" name="fee" value="{{ $request->fee }}">
                            <input type="hidden" name="imgpath" value="{{ $request->imgpath }}">
                            <input type="submit" value="追加する" class="btn btn-primary btn-sm text-center delete-btn">
                        </form>

                    </div>

                    <a href="{{ route('main') }}">商品一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection