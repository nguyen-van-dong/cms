



@extends('core::v2.admin.master')

@section('title', __('cms::page.create.page_title'))

@section('breadcrumbs')
<div class="title_left" style="margin-bottom: 2em;">
	<div class="page-title-box">
		<div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cms.admin.page.index') }}">{{ __('cms::page.index.page_title') }}</a></li>
            <li class="breadcrumb-item active">{{ __('cms::page.create.page_title') }}</li>
        </ol>
		</div>
	</div>
</div>
@endsection

@section('content')
<form action="{{ route('cms.admin.page.store') }}" method="POST">
  @csrf
  <div class="row" style="display: block;">
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12">
      <div class="x_panel">
        @include('cms::v2.admin.page._fields', ['item' => null])
      </div>
    </div>
  </div>
</form>
@stop
