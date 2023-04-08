@extends('core::v2.admin.master')

@section('title', __('cms::category.index.page_title'))

@section('breadcrumbs')
<div class="title_left">
  <div class="page-title-box">
    <div class="page-title-right">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><i class="fa fa-home mr-1"></i><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ __('Category') }}</li>
      </ol>
    </div>
  </div>
</div>
@endsection

@section('search')
<div class="title_right">
  <div class="col-md-5 col-sm-5 form-group pull-right top_search">
    <div class="input-group">

      <!-- @translatable -->
    </div>
  </div>
</div>
@endsection

@section('content')
<form role="form" action="{{ route('cms.admin.category.store') }}" method="POST" id="category-form">
  @csrf
  <div class="row mt-5" style="display: block;">
    <div class="clearfix"></div>
    <div class="col-md-4 col-sm-4">
      <!-- <button type="submit" class="btn btn-primary" style="font-size: 1.1em;"><i class="fa fa-save"></i> {{ __('Collapse') }}</button> -->
      <a class="btn btn-primary" href="{{ route('cms.admin.category.index') }}" style="font-size: 1.1em;"><i class="fa fa-arrow-circle-o-right"></i> {{ __('Create') }}</a>
      <a class="btn btn-danger" href="#" data-toggle="modal" data-target=".modal-delete-record" id="btn-delete" style="font-size: 1.1em; display: none"><i class="fa fa-trash"></i> {{ __('Delete') }}</a>
      <a id="element-trigger-1"></a>
      @if (count($treeCategory) > 0)
      <div
        id="tree-view-component-1"
        data-items='@json($treeCategory)'
        data-displayall="true"
        data-checkable="false"
        data-showline="true"
        style="border: 1px solid #ababab; border-radius: 5px; margin-top: 10px"></div>
      @endif
    </div>
    @include('cms::v2.admin.category.form')
  </div>
</form>

<div class="modal fade modal-delete-record" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2" style="color: red">Confirm delete!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body text-left">
        <h4>Are you sure delete this record?</h4>
      </div>
      <form method="POST" action="" id="form-delete">
        @method('DELETE')
        @csrf
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" id="btn-confirm-delete">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@push('script')
<script>
  $(document).ready(function() {
    $('#element-trigger-1').click(function(e) {
      e.preventDefault();
      $('#form-content').css('background-color', '#bebebe');
      const id = document.getElementById('element-trigger-1').dataset.id;
      $.get(`/admin/cms/category/${id}/edit`, (data, status) => {
        $('#form-content').replaceWith(data.item);
        $('#category-form').attr('action', data.route);
        if ($('input[name="_method"]').length === 0) {
          $('#category-form').append(`<input type="hidden" name="_method" value="PUT">`);
        }
        $('#btn-delete').attr('href', data.delete_url);
        $('#btn-delete').css('display', 'inline');
      });
    });

    $('#btn-delete').click(function() {
      const url = $(this).attr('href');
      $('#form-delete').attr('action', url);
    });
  })
</script>
@endpush
