@extends('frontend.layouts.default')
@section('content')
    <div class="row">
        <div class="col-xs-9">
            <div class="featured-heritages">
                @if(!empty($photoAlbums))
                    <?php $j = 0; ?>
                    @foreach($photoAlbums as $photoAlbum)
                        <?php $j++; ?>
                        <div class="media @if($j>4) media-medium @endif"  title="{!! $photoAlbum->title !!}">
                            <a href="{{ route('frontend.photo.show', [str_slug($photoAlbum->title), $photoAlbum->id]) }}">
                                <div class="media-content">
                                    <img src="{{ asset($photoAlbum->thumbnail) }}" alt="{{ $photoAlbum->title }}">

                                    <div class="desc-media ellipsis">
                                        {{ $photoAlbum->title }}
                                    </div>
                                    <div class="hover-media">
                                        <div class="hover-btn">
                                            <button class="btn btn-lg">{{ trans('default.discover') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="area-lists">
                <ul class="lists">
                    @if(!empty($areas))
                        @foreach($areas as $area)
                            <li>
                                <a href="{{ route('frontend.area.show', [str_slug($area->name), $area->id]) }}">
                                    <h6>{{ $area->name }}</h6>
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="coming-heritages">
                <h3 class="title">{{ trans('default.heritage_by_unesco') }}</h3>

                <div class="box-media-child">
                    @foreach($unescoHeritages as $unescoHeritage)
                        <div class="media media-child">
                            <a href="{{ route('frontend.heritage.show', [str_slug($unescoHeritage->title), $unescoHeritage->id]) }}">
                                <img src="{{ asset($unescoHeritage->thumbnail) }}" alt="{!! $unescoHeritage->title !!}"/>
                            </a>

                            <div class="desc-media ellipsis">
                                <a href="{{ route('frontend.heritage.show', [str_slug($unescoHeritage->title), $unescoHeritage->id]) }}" title="{!! $unescoHeritage->title !!}">{!! $unescoHeritage->title !!}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="interest-heritages">
                <h6 class="title">{{ trans('default.information_on_all_heritage') }}</h6>
                @if(!empty($heritages))
                    <ul class="list-unstyled">
                        @foreach($heritages as $heritage)
                            <li class="ellipsis">
                                <a href="{{ route('frontend.heritage.show', [str_slug($heritage->title), $heritage->id]) }}" title="{!! $heritage->title !!}">{!! $heritage->title !!}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <div class="col-xs-3 sidebar">
            @include('frontend.widgets.popular_heritages')
            @include('frontend.widgets.ads')
        </div>
    </div>
@stop
@include('frontend.widgets.meta')