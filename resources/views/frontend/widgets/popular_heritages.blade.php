<div class="widget popular-posts">
    <h3 class="widget-title">
        {{ trans('default.popular_heritages') }}
    </h3>
    <div class="widget-content">
        @if(!empty($popular_heritages))
            <ul class="">
                @foreach($popular_heritages as $item)
                    <li>
                        <a class="img-widget" href="{{ route('frontend.heritage.show', [str_slug($item->title), $item->id]) }}">
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}"/>
                        </a>

                        <div class="description">
                            <a class="title" href="{{ route('frontend.heritage.show', [str_slug($item->title), $item->id]) }}">{{ $item->title }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>