<a class="btn btn-light text-success @isset($class) {{ $class }} @endisset" href="{{ $href }}">
    <i class="fa fa-check"></i> {{ $slot ?? '' }}
</a>