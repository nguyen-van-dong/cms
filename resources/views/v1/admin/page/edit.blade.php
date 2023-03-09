@extends('core::v1.admin.master')

@section('meta_title', __('cms::page.edit.page_title'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cms.admin.page.index') }}">{{ __('cms::page.edit.index') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('cms::page.edit.page_title') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('cms::page.edit.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('cms.admin.page.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="fs-17 font-weight-600 mb-2">
                                    {{ __('cms::page.edit.page_title') }}
                                </h4>
                                @translatableAlert
                            </div>
                            <div class="text-right">
                                <div class="btn-group">
                                    <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
                                    <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('cms::admin.page._fields', ['item' => $item])
                    </div>
                    <div class="card-footer text-right">
                        <div class="btn-group">
                            <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
                            <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('cms::page.language') }}</h3>
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
