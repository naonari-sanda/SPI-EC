@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- フラッシュメッセージ -->
            @if (session('flash_message'))
            <div class="flash_message alert-success text-center py-3 my-2">
                {{ session('flash_message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">メールアドレス変更</div>

                <div class="card-body">
                    <form action="/email" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">新規メールアドレスを<br>ご入力してください</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="new_email" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    メールアドレス再設定URLを送信
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection