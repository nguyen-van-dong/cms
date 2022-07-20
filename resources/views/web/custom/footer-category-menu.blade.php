<div class="col-sm-4 col-6 footer-list-28">
    <h6 class="footer-title-28">{{ __('cms::web.category.index') }}</h6>
    <ul>
        @foreach($items as $catItem)
        <li><a target="{{ $catItem->target }}" href="{{ $catItem->url ?? '#' }}">{{ $catItem->label }}</a></li>
        @endforeach
    </ul>
</div>
