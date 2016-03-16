$.fn.exists = function () {
    return this.length > 0;
};
var base = {
    showNotification: function (type, content) {
        noty({
            text: content,
            type: type,
            theme: 'andy_theme',
            layout: 'bottomRight',
            closeWith: ['button'],
            maxVisible: 1,
            timeout: 5000,
            animation: {
                open: 'animated bounceInRight', // Animate.css class names
                close: 'animated bounceOutRight',
                easing: 'easeOutQuint',
                speed: 500
            }
        });
    }
};
$(function () {
    // Notification
    if ($('.notificationJS').exists()) {
        var notification = $('.notificationJS');
        base.showNotification(notification.data('type'), notification.find('p').html());
    }
});

$('.datetimepicker').datepicker();