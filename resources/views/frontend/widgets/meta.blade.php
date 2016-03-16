@section('meta')
    <meta content="vi-VN" itemprop="inLanguage">
    <link href="{{ URL::full() }}" rel="publisher">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ URL::full() }}">
    <meta property="og:title" content="@if(!empty($meta['title'])){!! $meta['title'] !!}@endif">
    <meta property="og:description" content="@if(!empty($meta['description'])){!! strip_tags($meta['description']) !!}@endif">
    <meta name="keywords" content="@if(!empty($meta['keywords'])){!! $meta['keywords'] !!}@endif">
    <meta property="og:image" content="@if(!empty($meta['image'])){!! $meta['image'] !!}@endif">
@stop