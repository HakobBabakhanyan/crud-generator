<li class="nav-item {{ (isset($active) && $active==$name)?'active':null }}">
    <a class="nav-link" href="{{ $route }}">
        <i class="{{ $fa_icon }}"></i>
        <span>{{ $name }}</span></a>
</li>
