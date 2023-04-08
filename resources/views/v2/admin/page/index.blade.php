@extends('core::v2.admin.master')

@section('title', __('cms::page.index.page_title'))

@section('breadcrumbs')
<div class="title_left">
  <div class="page-title-box">
    <div class="page-title-right">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ __('cms::page.index.page_title') }}</li>
      </ol>
    </div>
  </div>
</div>
@endsection

@section('search')
<div class="title_right">
  <div class="col-md-5 col-sm-5 form-group pull-right top_search">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="row" style="display: block;">
  <div class="clearfix"></div>
  <div class="col-md-12 col-sm-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Page list</h2>
        <div class="clearfix text-right">
          <x-button-create url="{{ route('cms.admin.page.create') }}" />
          <x-button-reload url="{{ route('cms.admin.page.index') }}" />
        </div>
      </div>

      <div class="x_content">

        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th>
                <th>ID</th>
                <th>{{ __('cms::page.name') }}</th>
                <th>{{ __('cms::page.key') }}</th>
                <th>{{ __('cms::page.is_active') }}</th>
                <th>@translatableHeader</th>
                <th>{{ __('cms::page.created_at') }}</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach($items as $key => $item)
              <tr class="{{ $key % 2 == 0 ? 'odd' : 'even' }} pointer">
                <td class="a-center ">
                  <input type="checkbox" class="flat" name="table_records">
                </td>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('cms.admin.page.edit', $item->id) }}">{{ $item->name }}</a></td>
                <td>
                  <code>{<span>!!</span> \Page::renderPage('{{ $item->key }}') !!}</code>
                </td>
                <td>
                  @if($item->is_active)
                  <i class="fa fa-check text-success"></i>
                  @endif
                </td>
                <td>
                  @translatableStatus(['editUrl' => route('cms.admin.page.edit', $item->id)])
                </td>
                <td>{{ $item->created_at }}</td>
                <td class="text-right">
                  @admincan('cms.admin.page.edit')
                  <x-button-edit url="{{ route('cms.admin.page.edit', $item->id) }}" title="Edit profile" icon="fa fa-pencil-square-o" />
                  @endadmincan
                  @admincan('cms.admin.page.destroy')
                  <x-button-delete url="{{ route('cms.admin.page.destroy', $item->id) }}" />
                  @endadmincan
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure delete the items?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" style="margin-left: 183px;">
        <a href="#" class="btn btn-success deleteImageListView" id="deleteImageListView" onclick="deleteCheckedCustomerItem()">Yes</a>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
        <div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script>
  function isDisplayDeleteButton() {
    var baseCheck = $('.itemCustomer').is(":checked");
    $('.itemCustomer').each(function() {
      if (!$(this).is(':disabled')) {
        if (baseCheck) {
          $('#btnDeleteCustomer').css('display', 'inline');
        } else {
          $('#btnDeleteCustomer').css('display', 'none');
        }
      }
    });
  }

  function checkCustomerItem(baseId, itemClass) {
    var baseCheck = $('#' + baseId).is(":checked");
    if (baseCheck) {
      $('#btnDeleteCustomer').css('display', 'inline');
    } else {
      $('#btnDeleteCustomer').css('display', 'none');
    }
    $('.' + itemClass).each(function() {
      if (!$(this).is(':disabled')) {
        $(this).prop('checked', baseCheck);
      }
    });
  }

  function deleteCheckedCustomerItem() {
    let arrayCustomerIds = [];
    $('input:checkbox.itemCustomer').each(function() {
      var sThisVal = (this.checked ? $(this).val() : "");
      if (sThisVal) {
        arrayCustomerIds.push(sThisVal);
      }
    });
    if (arrayCustomerIds.length > 0) {
      $.ajax({
        url: adminPath + '/customer/customer/' + JSON.stringify(arrayCustomerIds),
        method: 'DELETE',
        data: {
          "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
          location.reload();
        },
        error: function(e) {
          console.log(e)
        }
      });
    } else {
      alert('Please choose at least a item.')
    }
  }
</script>

<script src="{{ asset('vendor/cms/assets/admin/js/post.js') }}"></script>
@endpush