@extends('cms::web.master')

@section('title', __('cms::web.home.title'))

@section('content')

    @include('cms::web.home.latest-post')

    @include('cms::web.home.may-u-like')

    @include('cms::web.home.course')

@stop
