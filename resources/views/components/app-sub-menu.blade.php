@php
    $menu = config('menu.sub_menu');
@endphp

<div class="sub-menu">
    @foreach ($menu as $index => $item)
        @if (($item['is_seller'] === true || $item['is_login'] === true) && !auth()->user()?->isSeller())
            @continue
        @endif
        <div class="sub-menu-item">
            <p class="sub-menu-title" data-bs-toggle="collapse" data-bs-target="#collapseSubmenu{{ $index }}"
                aria-expanded="false" aria-controls="collapseSubmenu{{ $index }}">
                {{ $item['title'] }}
            </p>
            <div class="sub-menu-list collapse{{ $item['is_show'] ? ' show' : '' }}"
                id="collapseSubmenu{{ $index }}">
                <div class="c-menu">
                    <ul class="c-menu-item">
                        @foreach ($item['menu_item'] as $citem)
                            @if (!$citem['route_name'] || (isset($citem['is_seller']) && $citem['is_seller'] === true && !auth()->user()->isSeller()))
                                @continue
                            @endif
                            <li><a href="{{ route($citem['route_name']) }}">{{ $citem['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
