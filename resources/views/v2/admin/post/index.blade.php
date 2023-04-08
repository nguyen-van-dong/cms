@extends('core::v2.admin.master')

@section('meta_title', __('cms::post.index.page_title'))

@section('breadcrumbs')
<div class="title_left">
  <div class="page-title-box">
    <div class="page-title-right">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><i class="fa fa-home mr-1"></i><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        @if (!isset($category))
        <li class="breadcrumb-item active">{{ __('cms::post.index.page_title') }}</li>
        @else
        <li class="breadcrumb-item"><a href="{{ route('cms.admin.post.index') }}">{{ __('cms::post.index.page_title') }}</a></li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
        @endif
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
        <h2>Posts list</h2>
        <div class="clearfix text-right">
          <x-button-create url="{{ route('cms.admin.post.create') }}" />
          <x-button-reload url="{{ route('cms.admin.post.index') }}" />
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
                <th>{{ __('cms::post.name') }}</th>
                <th>{{ __('cms::post.category') }}</th>
                <th>{{ __('cms::post.viewed') }}</th>
                <th>{{ __('cms::post.comment') }}</th>
                <th>{{ __('Published at') }}</th>
                <th>@translatableHeader</th>
                <th></th>
              </tr>
            
                <!-- <th class="column-title no-link last"><span class="nobr">Action</span>
                </th> -->
              <!-- <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th> -->
              <!-- </tr> -->
            </thead>

            <tbody>
              @foreach($items as $key => $item)
              <tr class="{{ $key % 2 == 0 ? 'odd' : 'even' }} pointer">
                <td class="a-center ">
                  <input type="checkbox" class="flat" name="table_records">
                </td>
                <td><a href="{{ route('cms.admin.post.edit', $item->id) }}">{{ $item->name }}</a></td>
                <td>
                  @foreach($item->categories as $category)
                  <span style="background: aquamarine; padding: 5px; border-radius: 5px; color: white; margin-right: 5px">
                    <a href="{{ route('cms.admin.category.show', $category->id) }}">{{ $category->name }}</a>
                  </span>
                  @endforeach
                </td>
                <td>{{ $item->view_count }}</td>
                <td>
                  <a href="{{ route('cms.admin.post.comment', $item->id) }}">{{ $item->comments->count() }}</a>
                </td>
                <td>
                  @if ($item->is_active)
                  <i class="fa fa-check text-success"></i>
                  <a href="#" data-post-id="{{ $item->id }}" title="Un-published" data-is_publish="0" class="mr-1 btnUnPublish">
                    Un-published Now
                  </a>
                  @else
                  <i class="fa fa-minus-square" style="color: red"></i>
                  <a href="#" data-post-id="{{ $item->id }}" title="Publish now" data-is_publish="1" class="mr-1 btnPublishPost">
                    Published Now
                  </a>
                  @endif
                </td>
                <td>
                  @translatableStatus(['editUrl' => route('cms.admin.post.edit', $item->id)])
                </td>
                <td class="text-right">
                  @admincan('cms.admin.post.edit')
                  <x-button-edit url="{{ route('cms.admin.post.edit', $item->id) }}" title="Edit profile" icon="fa fa-pencil-square-o" />
                  @endadmincan
                  @admincan('cms.admin.post.destroy')
                  <x-button-delete url="{{ route('cms.admin.post.destroy', $item->id) }}" />
                  @endadmincan
                </td>
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