@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (isset(Auth::user()->name))
                    Добавить новые данные!!!

                    <form method="POST" action="{{url('sent')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="text" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="message" name="message" cols="40"
                                          rows="6"></textarea>
                            </div>
                            <input type="file" name="image">
                            <input type="hidden" id="lat" name="lat" value="">
                            <input type="hidden" id="lng" name="lng" value="">
                            <input type="hidden" id="user" name="user" value="<?=Auth::user()->name?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?=Auth::user()->id?>">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Отправить форму') }}</button>
                    </form>
                    <div class="map" id='map'>
                        <gmap-map
                                :center="center"
                                :zoom="9"
                                ref="map"
                                v-bind="options"
                        @click="onMapClick"
                        map-type-id="terrain"
                        style="width: 350px
                        ;
                            height: 150px
                        ;
                            left: 700px
                        ;
                            margin-top: -250px
                        ;"
                        >
                        <gmap-marker
                                v-for="m in markers"
                                :key="m.id"
                                :position="m.position"
                                :clickable="true"
                                :draggable="true"
                        @click="onMarkerClick">
                        >
                        </gmap-marker>

                        </gmap-map> </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container footer" style="margin-top: 150px; margin-left: 500px;">
        @foreach ($services as $service)
            User:   {{ucfirst($service->user)}} <br>
            Title:   {{ucfirst($service->title)}}
            <div class="justify-content-center footer">
                Message:    {{$service->body}}
                <div class="footer">
                    <br>
                    <a href="page/{{$service->user_id}}">{{$service->user}}</a>
                    <br>
                    <img src="{{url($service->path_image)}}">
                    <gmap-map
                            :center="center"
                            :zoom="9"
                            ref="map"
                            v-bind="options"
                    @click="onMapClick"
                    map-type-id="terrain"
                    style="height: 150px
                    ;
                        right: 20px
                    ;
                        width: 250px
                    ;"
                    >
                    <gmap-marker
                            :position="{ lat: {{$service->lat}}, lng: {{$service->lng}} }">
                    </gmap-marker>

                    </gmap-map>
                </div>
            </div>
        @endforeach
    </div>
@endsection    