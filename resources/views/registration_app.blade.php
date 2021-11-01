@extends('layouts.app')

@section('content')

		Registration app and get params for connect and get API
<form method="POST" action="{{url('/api/get/')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Redirect Url') }}</label>

                            <div class="col-md-6">
                                <input type="url" class="form-control" name="redirect">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Name App') }}</label>

                            <div class="col-md-6">
                                <input type="name" class="form-control" name="name">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Get Params') }}</button>
                    </form>
@endsection