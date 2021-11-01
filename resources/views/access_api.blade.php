@extends('layouts.app')

@section('content')
@if(session('oauth_clients'))
@php $oauth_clients = session('oauth_clients'); @endphp

Your access for get Api!!!<br>

Your ID is: {{$oauth_clients['id']}} 

<br>

Your KEY is: {{$oauth_clients['secret']}} 

<br>
Your Redirect URL is: {{$oauth_clients['redirect']}}

@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<br>
Fill the form to get API Data

<form method="POST" action="{{url('/redirect')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Your ID') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Your KEY') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="key">
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Redirect Url') }}</label>

                            <div class="col-md-6">
                                <input type="url" class="form-control" name="redirect">
                            </div>
                        </div>

                        
                        <button type="submit" class="btn btn-primary">{{ __('Get API data') }}</button>
                    </form>

@endsection
