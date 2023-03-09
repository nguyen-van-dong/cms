function PostAdmin() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('body').on('click', '.btnPublishPost, .btnUnPublish', function (e) {
    e.preventDefault();
    let _this = $(this);
    if ($(this).data('is_publish')) {
      swal({ title: 'Please Waiting ...', text: 'Publishing...', buttons: false });
    } else {
      swal({ title: 'Please Waiting ...', text: 'Un-Publishing...', buttons: false });
    }
    $.ajax({
      url: adminPath + '/cms/post/published',
      method: 'POST',
      data: {
        post_id: $(this).data('post-id'),
        is_publish: $(this).data('is_publish')
      },
      success: function (response) {
        if (response.success) {
          $(_this).siblings('i').remove();
          if (response.is_published == 1) {
            $(_this).replaceWith('<i class="fas fa-check text-success"></i>' +
              '<a href="#" data-post-id="' + response.post_id + '" data-is_publish="0" title="Un-published" class="mr-1 btnUnPublish">\n' +
              '    Un-published Now\n' +
              '</a>')
          } else {
            $(_this).replaceWith('<i class="fa fa-minus-square" style="color: red"></i>' +
              '<a href="#" data-post-id="' + response.post_id + '" data-is_publish="1" title="Publish now" class="mr-1 btnPublishPost">\n' +
              'Published Now' +
              '</a>')
          }
          swal.close()
        }
      },
      error: function (error) {
        console.log(error)
      }
    });
  });
}

$(document).ready(function () {
  new PostAdmin();
});
