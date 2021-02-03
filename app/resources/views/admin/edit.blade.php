@extends('layouts.admin')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品の編集</div>

                @if(isset( $stock ))

                <div class="card-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.update') }}" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">商品名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $stock->name) }}" autocomplete=" name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detail" class="col-md-4 col-form-label text-md-right">詳細</label>

                            <div class="col-md-6">
                                <textarea id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="" autocomplete="detail">{{ old('detail', $stock->detail )}}
                                </textarea>

                                @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fee" class="col-md-4 col-form-label text-md-right">値段</label>

                            <div class="col-md-6">
                                <input id="fee" type="text" class="form-control @error('fee') is-invalid @enderror" name="fee" value="{{ old('fee', $stock->fee) }}" autocomplete="fee">

                                @error('fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img" class="col-md-4 col-form-label text-md-right">現在画像</label>

                            <div class="col-md-6">
                                <img style="width: 100%;" class="is-invalid" src="{{ asset('/uploads/' . $stock->imgpath) }}" alt=""> </div>
                        </div>

                        <div class="form-group row">
                            <label for="imgpath" class="col-md-4 col-form-label text-md-right">新規画像</label>

                            <div class="col-md-6">
                                <input id="imgpath" type="file" name="imgpath" value="" class="@error('imgpath') is-invalid @enderror" accept=".png, .jpeg, .jpg">

                                @error('imgpath')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                アップロード
                            </button>

                        </div>
                    </form>
                </div>

                @endif

            </div>
        </div>
    </div>
</div>

@endsection