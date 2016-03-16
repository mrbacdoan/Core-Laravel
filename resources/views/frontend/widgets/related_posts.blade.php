<div class="row row-eq-height">
    @foreach($relatedPosts as $item)
        <div class="col-md-4 item">
            <div class="img">
                <a href="{{ route('frontend.post.show', [str_slug($item->title), $item->id]) }}">
                    <img src="{{ asset($item->thumbnail) }}" alt="{!! $item->title !!}">
                </a>
            </div>
            <h4 class="title ellipsis" title="{!! $item->title !!}">
                <a href="{{ route('frontend.post.show', [str_slug($item->title), $item->id]) }}">{!! $item->title !!}</a>
            </h4>
        </div>
    @endforeach
</div>