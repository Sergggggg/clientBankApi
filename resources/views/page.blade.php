@extends('layouts.app')

@section('content')
<div class="container footer">
@foreach ($page as $pages)
User:   {{ucfirst($pages->user)}} <br>
Title:   {{ucfirst($pages->title)}}
    <div class="justify-content-center footer">
Message:    {{$pages->body}}
        <div class="footer">
        <img src="{{url($pages->path_image)}}">
            <gmap-map
                      :center="center"
                      :zoom="9"
                      ref="map"
                      v-bind="options"
                      @click="onMapClick"
                      map-type-id="terrain"
                      style="height: 150px;right: 20px;width: 250px;"
                    >
                    <gmap-marker
            :position="{ lat: {{$pages->lat}}, lng: {{$pages->lng}} }">
        </gmap-marker>

                    </gmap-map>
        </div>
        </div>
@endforeach
        </div>


@endsection 