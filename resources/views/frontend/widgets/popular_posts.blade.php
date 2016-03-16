<div class="widget popular-posts">
    <h3 class="widget-title">
        {{ trans('default.popular_heritages') }}
    </h3>
    <div class="widget-content">
        @if(!empty($popular_posts))
            <ul class="">
                @foreach($popular_posts as $popular_post)
                    <li>
                        <a class="img-widget" href="">
                            <img src="{{ asset($popular_post->thumbnail) }}" alt="{{ $popular_post->title }}"/>
                        </a>

                        <div class="description">
                            <a class="title" href="">{{ $popular_post->title }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>