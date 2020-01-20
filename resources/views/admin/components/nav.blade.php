<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach($items as $item)
            <a class="nav-item nav-link {{ (!$loop->index)?'active':null }}" data-toggle="tab" href="#{{$item->slug.'-'.$name }}"
               role="tab" aria-controls="nav-home" aria-selected="true">
                {{$item->name}}
            </a>
            @endforeach
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    {{ $slot }}
</div>
