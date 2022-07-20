@extends('core::admin.master')

@section('meta_title', __('cms::category.index.page_title'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ __('cms::category.index.page_title') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('cms::category.index.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="mb-2">
                    <div class="row">
                        <div class="col-12 text-sm-center form-inline">
                            <div class="form-group mr-2">
                                <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route('cms.admin.category.create') }}"><i class="mdi mdi-plus-circle mr-2"></i> Add New</a>
                            </div>
                            <div class="form-group">
                                <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('cms::category.name') }}</th>
                            <th>{{ __('cms::category.is_active') }}</th>
                            <th>@translatableHeader</th>
                            <th>{{ __('cms::category.created_at') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href="{{ route('cms.admin.category.edit', $item->id) }}">
                                        {{ trim(str_pad('', $item->depth * 3, '-')) }}
                                        {{ $item->name }}
                                    </a>
                                    <a href="#" target="_blank" title="{{ __('core::button.view') }}">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    @if($item->is_active)
                                        <i class="fas fa-check text-success"></i>
                                    @endif
                                </td>
                                <td>
                                    @translatableStatus(['editUrl' => route('cms.admin.category.edit', $item->id)])
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-right">
                                    @admincan('cms.admin.category.create')
                                    <a href="{{ route('cms.admin.category.create', ['id' => $item->id, 'parent_id' => $item->id]) }}" class="btn btn-primary-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                        <i class="fas fa-plus" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                                    </a>
                                    @endadmincan

                                    @admincan('cms.admin.category.edit')
                                    <a href="{{ route('cms.admin.category.move-up', $item->id) }}" class="btn btn-info-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                        <i class="fas fa-chevron-up" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                                    </a>
                                    @endadmincan

                                    @admincan('cms.admin.category.edit')
                                    <a href="{{ route('cms.admin.category.move-down', $item->id) }}" class="btn btn-info-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                        <i class="fas fa-chevron-down" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                                    </a>
                                    @endadmincan

                                    @admincan('cms.admin.category.edit')
                                    <a href="{{ route('cms.admin.category.edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                        <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                                    </a>
                                    @endadmincan

                                    @admincan('cms.admin.category.destroy')
                                    <button-delete url-delete="{{ route('cms.admin.category.destroy', $item->id) }}"></button-delete>
                                    @endadmincan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@stop
