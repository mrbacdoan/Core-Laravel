$.widget.bridge('uibutton', $.ui.button);

$('#confirm-delete').on('show.bs.modal', function (e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
// cropbox
var options =
{
    thumbBox: '.thumbBox',
    spinner: '.spinner',
    imgSrc: accounts.avatar
};
var cropper = $('.imageBox').cropbox(options);
$('#file').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        options.imgSrc = e.target.result;
        cropper = $('.imageBox').cropbox(options);
    };
    reader.readAsDataURL(this.files[0]);
    this.files = [];
});
$('#btnCrop').on('click', function () {
    var img = cropper.getDataURL();
    $.ajax({
        method: "POST",
        url: accountUrl.changeAvatar,
        data: {img: img, '_token': _token}
    }).done(function (result) {
        switch (result.code) {
            case 200:
                $('.avatar').attr('src', BASE_URL + '/' + result.data.urlImage);
                base.showNotification('success', result.data.msg);
                break;
            case 0:
                base.showNotification('error', result.msg);
                break;
        }
        $('#change-avatar').modal('toggle');
    });
});

$('#btnZoomIn').on('click', function () {
    cropper.zoomIn();
});
$('#btnZoomOut').on('click', function () {
    cropper.zoomOut();
});