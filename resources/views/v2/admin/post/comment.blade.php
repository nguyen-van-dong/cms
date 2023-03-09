@extends('core::v2.admin.master')

@section('meta_title', __('Comment'))

@section('content-header')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms.admin.post.index') }}">{{ __('Post') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Comment') }}</li>
                </ol>
            </div>
            <h4 class="page-title">Comment @if (isset($items[0])) in "{{ $items[0]->table()->first()->name }}" @endif</h4>
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
                        <div class="col-4">
                            <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off" name="keyword" value="{{ request('keyword') }}">
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
                            <td style="width: 60%;">
                                <a href="{{ route('cms.admin.category.edit', $item->id) }}">
                                    {{ trim(str_pad('', $item->depth * 3, '-')) }}
                                    {{ $item->content }}
                                </a>
                            </td>
                            <td>
                                @if ($item->is_published)
                                <i class="fas fa-check text-success"></i>
                                <a href="#" data-comment_id="{{ $item->id }}" title="Un-published" data-is_publish="0" class="btn-sm mr-1 btnUnPublish">
                                    Un-published Now
                                </a>
                                @else
                                <i class="fa fa-minus-square" style="color: red"></i>
                                <a href="#" data-comment_id="{{ $item->id }}" title="Publish now" data-is_publish="1" class=" btn-sm mr-1 btnPublishComment">
                                    Publish Now
                                </a>
                                @endif

                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td class="text-right">
                                @admincan('comment.admin.comment.create')
                                <a href="{{ route('comment.admin.comment.create', ['id' => $item->id, 'parent_id' => $item->id]) }}" class="btn btn-primary-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                    <i class="fas fa-plus" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                                </a>
                                @endadmincan

                                @admincan('comment.admin.comment.destroy')
                                <button-delete url-delete="{{ route('comment.admin.comment.destroy', $item->id) }}"></button-delete>
                                @endadmincan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@push('scripts')
<script src="{{ asset('vendor/comment/admin/js/comment.js') }}"></script>
@endpush
