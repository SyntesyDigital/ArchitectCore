@foreach(config('architect::menu') as $item)

    {{-- If current user can show this menu --}}
    @if(!empty($item['roles']))
        @if(!Auth::user()->hasRole([$item['roles']]))
            @continue;
        @endif
    @endif

    {{-- Request pattern for display active of not the menu item --}}
    @if(!empty($item['patterns']))
        @php
            $isActive = collect($item['patterns'])->filter(function($pattern){
                return Request::is($pattern) ? true : false;
            })->first();
        @endphp
    @endif

    @php 
        $display = true;
    @endphp 

    {{-- Is disabled --}}
    @foreach(config('architect::menu') as $item2)
        @if(isset($item2['disabled']) && isset($item['route']))
            @if($item['route'] == $item2['disabled'])
                @php 
                    $display = false;
                @endphp 
            @endif
        @endif
    @endforeach()

    {{-- Render the menu item --}}
    @if(isset($item['route']) && $display)
    <li class="{{ $isActive ? 'active' : false }}">
        <a href="{{ route($item['route']) }}">
            {{ Lang::get($item['label']) }}
        </a>
    </li>
    @endif

@endforeach()
