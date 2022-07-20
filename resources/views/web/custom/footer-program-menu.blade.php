
<div class="col-sm-4 col-6 footer-list-28">
    <h6 class="footer-title-28">{{ __('cms::web.program') }}</h6>
    <ul>
        @foreach($items as $mnItem)
        <li><a target="{{ $mnItem->target }}" href="{{ $mnItem->url ?? '#'}}">{{ $mnItem->label }}</a></li>
        @endforeach
    </ul>
</div>
