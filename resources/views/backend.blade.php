<!DOCTYPE html>
<html lang="en" data-ng-app="angle">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="app, responsive, angular, bootstrap, dashboard, admin">
    <title data-ng-bind="::pageTitle()"></title>
    <!-- Bootstrap styles-->
    <link rel="stylesheet" href="{{ asset('app/css/bootstrap.css') }}" data-ng-if="!app.layout.isRTL">
    <link rel="stylesheet" href="{{ asset('app/css/bootstrap-rtl.css') }}" data-ng-if="app.layout.isRTL">
    <!-- Application styles-->
    <link rel="stylesheet" href="{{ asset('app/css/app.css?v=1.1.8') }}" data-ng-if="!app.layout.isRTL">
    <link rel="stylesheet" href="{{ asset('app/css/app-rtl.css') }}" data-ng-if="app.layout.isRTL">
    <!-- Themes-->
    <link rel="stylesheet" ng-href="@{{app.layout.theme}}" data-ng-if="app.layout.theme">
    <script>
        const BASE_URL = "{{url('/')}}/";
        const ADMIN_API_URL = "{{url(API_PREFIX_ADMIN)}}/";
        const STYLE_VERSION = '?v={{ time() }}';
    </script>
</head>
<body data-ng-class="{ 'layout-fixed' : app.layout.isFixed, 'aside-collapsed' : app.layout.isCollapsed, 'layout-boxed' : app.layout.isBoxed, 'layout-fs': app.useFullLayout, 'hidden-footer': app.hiddenFooter, 'layout-h': app.layout.horizontal, 'aside-float': app.layout.isFloat}">
<toaster-container toaster-options="{'close-button': true}"></toaster-container>
<div data-ui-view="" data-autoscroll="false" class="wrapper"></div>
<script src="{{ asset('app/js/base.js') }}"></script>
<script src="{{ asset('app/js/app.js') }}"></script>
<?php echo '<script>const APP_CONSTANT = ' . (json_encode($constants)) . ';</script>';?>
@if(request()->getClientIp() == '127.0.0.1')
    <script src="//localhost:35729/livereload.js?snipver=1"></script>
@endif
</body>

</html>