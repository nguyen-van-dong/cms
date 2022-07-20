@foreach($items as $itCat)
<li style="margin: 10px 5px 0 0;"><a href="{{ $itCat->url }}"><span class="mr-3 {{ $itCat->class }}"></span>{{ $itCat->label }}</a></li>
@endforeach
