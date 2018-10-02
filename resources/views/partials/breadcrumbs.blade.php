@if (count($breadcrumbs))

    <nav>
        <div class="uk-container">
            <div class="uk-breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <a href="{{{ $breadcrumb->url }}}" class="breadcrumb">

{{--                            <img src="/{{ $breadcrumb->icon }}" style="height: 20px;">--}}

                            {{ $breadcrumb->title }}</a>
                    @else
                        <span class="breadcrumb">{{ $breadcrumb->title }}</span>
                    @endif

                @endforeach
            </div>
        </div>
    </nav>

@endif