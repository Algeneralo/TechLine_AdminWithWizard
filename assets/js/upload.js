// JavaScript Document

$(document).ready(function () {


    $('#upload_img').click(function (e) {
        e.preventDefault();
        var show = parseInt($('#Ushow').val());
        $.ajax({
            type: 'post',
            url: 'ajax/getMedia.php',
            data: {show: show},
            success: function (data) {
                $('#upload #Udata-media').html(data);
                $('#upload').modal('show');
                $('#upload .modal-body img').click(function () {
                    $(this).parent().find('.up_img').toggleClass('hidden');
                });
            }
        });

    });

    $('#Ushow').change(function () {
        var show = parseInt($(this).val());
        $.ajax({
            type: 'post',
            url: 'ajax/getMedia.php',
            data: {show: show},
            success: function (data) {
                $('#upload #Udata-media').html(data);
                $('#upload').modal('show');
                $('#upload .modal-body img').click(function () {
                    $(this).parent().find('.up_img').toggleClass('hidden');
                });
            }
        });
    });

    $('#upload #Uuploaded_img').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        var title = $('#upload input[name=title]').val();
        $.ajax({
            url: 'ajax/uploadImages?title=' + title,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) { //alert(data);
                if (data != 'false') {
                    $('#upload input[type=file]').val('');
                    var htmldata = CKEDITOR.instances.cke.getData();
                    htmldata += data;
                    CKEDITOR.instances.cke.setData(htmldata);
                }
                $('#upload').modal('hide');
            }
        });
        return false;
    });


    /***********noooooo */
    $('#upload #btnUpload').click(function () {
        //var images = [];
        var htmldata = CKEDITOR.instances.cke.getData();
        $('#upload .up_img').each(function () {
            if (!$(this).is('.hidden')) {
                //alert($(this).parent().find('img').data('media'));
                var name = $(this).parent().find('img').data('media');
                htmldata += '<img src="files/media/' + name + '" /> ';
            }
            $(this).addClass('hidden');
        });
        CKEDITOR.instances.cke.setData(htmldata);
        $('#upload').modal('hide');

    });
    $('#upload #btnDelete').click(function () {
        let counter = 0;
        let images = [];
        $('#upload .up_img').each(function () {
            if (!$(this).is('.hidden')) {
                let id = $(this).parent().find('img').data('id');
                let name = $(this).parent().find('img').data('media');
                images[counter++] = [id, name];
            }
            $(this).addClass('hidden');
        });
        $.ajax({
            url: 'ajax/deleteImages.php',
            type: 'POST',
            data: {
                'images': images
            },
            success: function (data) { //alert(data);
                $('#upload').modal('hide');
            }
        });
        $('#upload').modal('hide');

    });

});
