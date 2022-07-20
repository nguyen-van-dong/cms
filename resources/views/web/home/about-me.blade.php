@extends('cms::web.master')

@section('title', __('cms::web.about'))

@section('content')
    <div class="w3l-homeblock3 py-5">
        <div class="container">
             {!! \Page::renderPage('about-me') !!}
        </div>
    </div>
@stop
