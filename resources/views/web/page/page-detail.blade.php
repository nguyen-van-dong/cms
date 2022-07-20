@extends('cms::web.master')

@section('seometa')
    @seometa
@endsection

@section('title', settings('name_website').' - '.$item->name)

@section('content')
    <div class="w3l-homeblock3 py-5">
        <div class="container">
            {!! $item->content !!}
        </div>
    </div>
@stop
