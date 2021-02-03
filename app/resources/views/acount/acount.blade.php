@extends('layouts.app')

@section('content')

<div>

    <h2 class="mb-5">お客様情報</h2>

    <table class="table mb-3">
        <tbody>
            <tr>
                <th scope="col">名前</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th scope="col">メールアドレス</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th style="border-bottom: 1px solid #dee2e6;"> <a href="{{ route('reset.email') }}">メールアドレス変更</a></th>
                <th style="border-bottom: 1px solid #dee2e6;"><a href="">パスワード変更</a></th>
            </tr>
        </tbody>
    </table>


    <h2 class="mb-5">お届け先</h2>

    @if (isset($acount))

    <table class="table mb-3">
        <tbody>
            <tr>
                <th scope="col">郵便番号</th>
                <td>{{ $acount->zipcode }}</td>
            </tr>
            <tr>
                <th scope="col">都道府県</th>
                <td>{{ $acount->prefecture }}</td>
            </tr>
            <tr>
                <th scope="col">住所</th>
                <td>{{ $acount->adress }}</td>
            </tr>
            <tr>
                <th style="border-bottom: 1px solid #dee2e6;"> <a href="{{ route('edit.adress') }}">お届け先変更</a></th>
                <td style="border-bottom: 1px solid #dee2e6;"></td>
            </tr>
        </tbody>
    </table>
    @else
    <a href="{{ route('adress') }}" class="mb-3 d-block">お届け先を登録してください</a>
    @endif


    <h2 class="mb-5">過去の注文履歴</h2>

    @if (count($lists) > 0)

    @foreach ($lists as $list)

    <h4>{{ $list->created_at->format('Y年m月d日') }}</h4>
    <div class="media mb-3">
        <a class="media-left" href="#">
            <img src="{{ asset('/uploads/' . $list->imgpath) }}" alt="" class=" img-thumbnail" style="width: 150px;">
        </a>

        <div class="media-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>注文日</th>
                        <td>{{ $list->created_at->format('Y年m月d日') }}</td>
                    </tr>
                    <tr>
                        <th scope="col">商品名</th>
                        <td>{{ $list->name }}</td>
                    </tr>
                    <tr>
                        <th scope="col">値段</th>
                        <td>{{ number_format($list->fee) }}円</td>
                    </tr>
                    <tr>
                        <th scope="col">個数</th>
                        <td>{{ $list->qty }}</td>
                    </tr>
                    <tr>
                        @if (isset($list->stock->id))
                        <th style="border-bottom: 1px solid #dee2e6;"> <a href="{{ route('detail', ['id' => $list->stock->id]) }}">商品の詳細はこちら</a></th>
                        @else
                        <th class="text-danger" style="border-bottom: 1px solid #dee2e6;">こちらの商品は現在ございません</th>
                        @endif
                        <td style="border-bottom: 1px solid #dee2e6;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @endforeach

    @else

    <p>過去にご注文がございません</p>

    @endif


</div>


@endsection