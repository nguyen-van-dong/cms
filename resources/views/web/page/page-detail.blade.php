

@extends('master2')

@section('main-header')
<header class="archive-page-header">
  <div class="row">
    <div class="large-12 text-center col">
      <h1 class="page-title is-large uppercase">
        <span>Dịch Vụ</span>
      </h1>
      <div class="taxonomy-description">
        <p>Bản tin tuyển dụng mới nhất của hệ thống <a href="https://www.quoctien.vn"><b>Quốc Tiến – Hà Giang MôTô</b></a> tại Đà Nẵng và Quảng Nam…</p>
      </div>
    </div>
  </div>
</header>
@endsection

@section('content')
<div class="large-9 col">
<div class="row">
        {!! $item->content !!}
        </div>
</div>
@endsection