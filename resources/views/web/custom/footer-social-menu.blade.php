<div class="col-sm-4 col-6 footer-list-28 mt-sm-0 mt-4">
    <h6 class="footer-title-28">{{ __('cms::web.media') }}</h6>
    <ul class="social-icons">
        @foreach($items as $socialItem)
        <li class=""><a target="{{ $socialItem->target }}" href="{{ $socialItem->url ?? '#' }}">
                <span class="{{ $socialItem->class }}"></span>
                {{ $socialItem->label }}</a>
        </li>
        @endforeach
    </ul>
</div>
