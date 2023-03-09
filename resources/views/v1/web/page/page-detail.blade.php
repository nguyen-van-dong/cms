@extends('web.layout.master')

@section('seometa')
    @seometa
@endsection

@section('content')

<div class="page-title bg-img bg-6">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content align-items-center">
                    <h1 class="page-name">
                        {{ __('blog.intro') }}
                    </h1>
                    <ol class="breadcrumb">
                        <li class="item-current"><span>{{ __('blog.index') }}</span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-page-main-wrapper">
    <div class="container">
        <div class="row">
        {!! $item->content !!}
        </div>
    </div>
</div>
@endsection