@extends('core::v1.admin.master')

@section('meta_title', __('cms::post.index.page_title'))

@section('breadcrumbs')
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
            @if (!isset($category))
              <li class="breadcrumb-item active">{{ __('cms::post.index.page_title') }}</li>
            @else
              <li class="breadcrumb-item"><a
                  href="{{ route('cms.admin.post.index') }}">{{ __('cms::post.index.page_title') }}</a></li>
              <li class="breadcrumb-item active">{{ $category->name }}</li>
            @endif
          </ol>
        </div>
        <h4 class="page-title">{{ __('cms::post.index.page_title') }}</h4>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="mb-2">
            <form>
              <div class="row">
                <div class="col-2 form-inline">
                  <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route('cms.admin.post.create') }}"><i
                      class="mdi mdi-plus-circle mr-2"></i> Add New Post</a>
                </div>
                <div class="col-4">
                  <input id="demo-input-search2" type="text" placeholder="Search" class="form-control"
                         autocomplete="off" name="keyword" value="{{ request('keyword') }}">
                </div>
                <div class="col-3">
                  @php($published = (request('published')))
                  <select class="form-control" name="published">
                    <option value="">----- Please choose option -----</option>
                    <option value="1" @if (isset($published) && request('published') == 1) selected @endif>Published
                    </option>
                    <option value="0" @if ( isset($published) && request('published') == 0) selected @endif>UnPublised
                    </option>
                  </select>
                </div>
                <div class="col-2">
                  <input type="submit" value="Search" class="btn btn-secondary">
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
              <thead>
              <tr>
                <th>#</th>
                <th>ID</th>
                <th>{{ __('cms::post.name') }}</th>
                <th>{{ __('cms::post.category') }}</th>
                <th>{{ __('cms::post.viewed') }}</th>
                <th>{{ __('cms::post.comment') }}</th>
                <th>{{ __('Published at') }}</th>
                <th>@translatableHeader</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @foreach($items as $item)
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck{{ $item->id }}">
                      <label class="custom-control-label" for="customCheck{{ $item->id }}">&nbsp;</label>
                    </div>
                  </td>
                  <td>{{ $item->id }}</td>
                  <td><a href="{{ route('cms.admin.post.edit', $item->id) }}">{{ $item->name }}</a></td>
                  <td>
                    @foreach($item->categories as $category)
                      <span style="background: aquamarine; padding: 5px; border-radius: 5px; color: white">
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
                      <i class="fas fa-check text-success"></i>
                      <a href="#" data-post-id="{{ $item->id }}" title="Un-published" data-is_publish="0"
                         class="mr-1 btnUnPublish">
                        Un-published Now
                      </a>
                    @else
                      <i class="fa fa-minus-square" style="color: red"></i>
                      <a href="#" data-post-id="{{ $item->id }}" title="Publish now" data-is_publish="1"
                         class="mr-1 btnPublishPost">
                        Published Now
                      </a>
                    @endif
                  </td>
                  <td>
                    @translatableStatus(['editUrl' => route('cms.admin.post.edit', $item->id)])
                  </td>
                  <td class="text-right">
                    @admincan('cms.admin.post.edit')
                    <a href="{{ route('cms.admin.post.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1"
                       style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                      <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                    </a>
                    @endadmincan

                    @admincan('cms.admin.page.destroy')
                    <x-button-delete-v1 url="{{ route('cms.admin.post.destroy', $item->id) }}"/>
                    @endadmincan
                  </td>

                </tr>
              @endforeach

              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{ $items->links() }}
          </div>
        </div>
      </div>
    </div>

  <div class="modal fade" id="deleteImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Are you sure delete the items?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="margin-left: 183px;">
          <a href="#" class="btn btn-success deleteImageListView" id="deleteImageListView"
             onclick="deleteCheckedCustomerItem()">Yes</a>
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
      $('.itemCustomer').each(function () {
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
      $('.' + itemClass).each(function () {
        if (!$(this).is(':disabled')) {
          $(this).prop('checked', baseCheck);
        }
      });
    }

    function deleteCheckedCustomerItem() {
      let arrayCustomerIds = [];
      $('input:checkbox.itemCustomer').each(function () {
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
          success: function (response) {
            location.reload();
          },
          error: function (e) {
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
