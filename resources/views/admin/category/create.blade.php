@extends('core::admin.master')

@section('meta_title', __('cms::category.create.page_title'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cms.admin.category.index') }}">{{ __('cms::category.index.page_title') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('cms::category.create.index') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('cms::category.create.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <form role="form" action="{{ route('cms.admin.category.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('cms::category.create.page_title') }}</h3>
                        @translatableAlert
                    </div>
                    <div class="card-body">
                        @include('cms::admin.category._fields', ['item' => $item])
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('core::button.save') }}</button>
                        <button class="btn btn-secondary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('cms::category.language') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-12 col-md-12">
                            @translatable
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
