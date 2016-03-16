<?php
$alert = getNotification();
?>
@if(!empty($alert))
    <div class="notificationJS hidden" data-type="{{ $alert['type'] }}">
        <p> {{ $alert['message'] }}</p>
    </div>
@endif
