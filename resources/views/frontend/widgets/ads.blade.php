<div class="widget-ads">
    <div class="widget-content">
        @foreach($adv as $item)
            <div class="item">
                <a href="{{ $item->link }}" target="_blank">
                    @if($item->type == ADVERTISEMENT_TYPE_IMAGE)
                        <img src="{{ asset($item->content) }}" class="img-responsive" alt="{{ $item->title }}">
                    @else
                        {!! $item->content !!}
                    @endif
                </a>
            </div>
        @endforeach
    </div>
</div>