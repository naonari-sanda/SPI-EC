@extends('layouts.admin')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品の追加</div>


                <div class="card-body">


                    <form class="form-horizontal" role="form" method="post" action="{{ route('admin.confirm') }}" enctype='multipart/form-data'>
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">商品名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="detail" class="col-md-4 col-form-label text-md-right">詳細</label>

                            <div class="col-md-6">
                                <textarea id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="" autocomplete="on">{{ old('detail') }}
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
                                <input id="fee" type="text" class="form-control @error('fee') is-invalid @enderror" name="fee" value="{{ old('fee') }}" autocomplete="on">

                                @error('fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="img" class="col-md-4 col-form-label text-md-right">画像</label>
                            <div class="col-md-6">
                                <input id="imgpath" type="file" name="imgpath" class="@error('imgpath') is-invalid @enderror" accept=".png, .jpeg, .jpg">

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


            </div>
        </div>
    </div>
</div>

@endsection