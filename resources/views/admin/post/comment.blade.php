<div class="card-body table-responsive p-0">
  <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
    <thead>
      <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Content') }}</th>
        <th>{{ __('Is Publish') }}</th>
        <th>{{ __('cms::category.created_at') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td style="width: 45%;">
            {{ trim(str_pad('', $item->depth * 3, '-')) }}
            {{ $item->content }}
        </td>
        <td>
          @if($item->is_published)
          <span class="badge badge-success">Published</span>
          @else
          <span class="badge badge-danger">UnPublished</span>
          @endif
        </td>

        <td>{{ $item->created_at }}</td>
        <td class="text-right">
          @admincan('comment.admin.comment.create')
          <a data-toggle="modal" href="#" data-value="{{ json_encode($item) }}" data-target="#exampleModal" title="Reply" class="btn btn-success-soft btn-sm mr-1 btn-reply" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
            <i class="fa fa-reply" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
          </a>
          @endadmincan

          @admincan('comment.admin.comment.destroy')
          <x-button-delete-v1 url="{{ route('cms.admin.comment.destroy', $item->id) }}" />
          @endadmincan
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


<input type="hidden" value="{{ route('cms.admin.comment.reply', '__ID__') }}" id="url">
<input type="hidden" id="comment_id">
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trả lời bình luận "<span id="title"></span>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="content">Content</label>
          <textarea class="form-control" id="comment_content" placeholder="Enter content" rows="5"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-submit-reply">Reply Now</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ready(function() {
    $('.btn-reply').click(function(e) {
      e.preventDefault();
      const data = $(this).data('value');
      $('#comment_id').val(data.id);
      $('#title').text(data.content);
    });

    $('.btn-submit-reply').click(function() {
      const data = {
        parent_id: $('#comment_id').val(),
        post_id: '{{ $post->id }}',
        content: $('#comment_content').val(),
      };
      console.log({ data });
      let url = $('#url').val();
      url = url.replace('__ID__', $('#comment_id').val());
      $.ajax({
        url,
        method: 'POST',
        data,
        success: function(response) {
          window.location.reload();
        },
        error: function(err) {
          console.log({
            err
          });
        }
      })
    })
  })
</script>
@endpush