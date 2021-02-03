@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お届け先ご登録</div>
                <div class="card-body">

                    <form class="form-horizontal" role="form" method="post" action="{{ route('create.adress') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="zipcode" class="col-md-4 col-form-label text-md-right">郵便番号</label>

                            <div class="col-md-6">
                                <input id="zipcode" type="number" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" autocomplete=" name" autofocus>

                                @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prefecture" class="col-md-4 col-form-label text-md-right">都道府県</label>

                            <div class="col-md-6">
                                <input id="prefecture" type="text" class="form-control @error('prefecture') is-invalid @enderror" name="prefecture" value="{{ old('prefecture') }}" autocomplete="prefecture">

                                @error('prefecture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adress" class="col-md-4 col-form-label text-md-right">住所</label>

                            <div class="col-md-6">
                                <input id="adress" type="text" class="form-control @error('adress') is-invalid @enderror" name="adress" value="{{ old('adress') }}" autocomplete="adress">

                                @error('adress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                登録する
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection