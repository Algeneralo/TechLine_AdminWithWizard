// JavaScript Document


$(document).ready(function () {
    if ($('.check').is(':checked')) {
        $(this).parent().parent().find('.select_box').prop('disabled', false);
    } else {
        $(this).parent().parent().find('.select_box').prop('disabled', false);
    }

    $('[data-toggle="tooltip"]').tooltip();
    /*
    $('.date-range').change(function () {
        alert($(this).val());
    });*/


    $('.select2').attr('dir', 'rtl');
    $('.select2').css('width', '100%');
    $(".group-checkable").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('input:checkbox').click(function () {
        $(".group-checkable").not(this).prop('checked', this.checked);
    });

    $('input[name="page[]"]').click(function () {

        if ($(this).prop("checked") == true) {
            $(this).parent().find('input[type=number]').removeAttr('disabled');
            $(this).parent().find('input .p_id').removeAttr('disabled');
        }

        else if ($(this).prop("checked") == false) {
            $(this).parent().find('input[type=number]').attr('disabled', true);
            $(this).parent().find('input .p_id').attr('disabled', true);
        }
    });


    $(".check").on("click", function () {
        var t = $(this).parent().parent().find(".select_box");
        t.removeAttr("disabled");
    });

    var t;
    $('.active-confirm').on('click', function (e) {
        e.preventDefault();
        t = $(this);
        var message;
        let table = t.data('table');
        $('#myModal').attr('data-table', table);
        console.log(table);
        if ($(this).data('message') == 1) message = 'الغاء تفعيل'; else message = 'تفعيل';
        $('#myModal .modal-header h3').html(message);
        $('#myModal .modal-body p').html('هل أنت متأكد من <span style="color:red;">' + message + ' </span>هذا العنصر');
        $('#myModal').modal('show');
    });


    $('#btnYes').click(function () {
        var id = $(t).data('id');
        var status = $(t).data('message');
        var table = $('#myModal').data('table');

        $.ajax({
            type: 'post',
            url: 'ajax/active.php',
            data: {
                'id': id,
                'table': table,
                'status': status
            },
            success: function (data) {
                $(t).data('message', data);
                if (data == 0) {
                    $(t).removeClass('btn-warning');
                    $(t).addClass('btn-success');
                    $(t).attr('data-original-title', 'تفعيل');
                    $(t).parent().parent().find('#status_msg').html('<span class="badge badge-danger">غير مفعل</span>');
                    $('#myModal').modal('hide');
                } else if (data == 1) {
                    $(t).removeClass('btn-success');
                    $(t).addClass('btn-warning');
                    $(t).attr('data-original-title', 'إلغاء تفعيل');
                    $(t).parent().parent().find('#status_msg').html('<span class="badge badge-success">مفعل</span>');
                    $('#myModal').modal('hide');
                }
            }
        });
    });

    /*$("tr").click(function () {
        var id = $(this).data("id");
        var t = $(this).find('.btn1');
        $.ajax({
            type: "POST",
            url: "ajax/getContact.php",
            data: {
                "id": id
            },
            success: function(result){
            $("#contact_us").html(result);
            t.removeClass('btn-outline-warning').addClass("btn-outline-info");
            t.text("مقروء");
            $("#viewModalContact").modal("show");

        }});

    });*/

    $('.delete-confirm').on('click', function (e) {
        e.preventDefault();

        t = $(this);
        let table = t.data('table');
        $('#delModal').attr('data-table', table);

        var message = $(this).data('message');
        $('#delModal .modal-header h3').html(message);
        $('#delModal .modal-body p').html('هل أنت متأكد من <span style="color:red;">' + message + ' </span>هذا العنصر');
        $('#delModal').modal('show');
    });

    $('#btnYes1').click(function () {
        var id = $(t).data('id');
        var table = $('#delModal').data('table');
        $.ajax({
            type: 'post',
            url: 'ajax/delete.php',
            data: {
                'id': id,
                'table': table
            },
            success: function (data) {
                if (table == 'images') {
                    $(t).parent().fadeOut('1000');
                } else {
                    $(t).parent().parent().fadeOut('1000');
                }

                $('#delModal').modal('hide');
            }
        });
    });
    /*
    $('.cars_images').click(function(){
      var t = $(this);
      var id = $(this).find('img').data('media');
      var table = 'images';
      $.ajax({
                type: 'post',
                url: 'ajax/delete.php',
                data: {
                    'id': id,
                    'table': table
                },
                success: function (data) {
                     t.fadeOut(1000);
                }
            });
    });
    */
    $('#up_img').submit(function (e) {
        e.preventDefault();
        var img = "";
        img = $('.card-block input[name=image]').val();


        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'ajax/upload_image.php?img=' + img,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) { //alert(data);
                if (data != 'false') {
                    $('.card-block input[name=image]').val(data);
                    $('.uploads img').attr('src', '../files/media/' + data);
                }
                $('#up_img input').val('');
                $('#edit-pic').modal('hide');
            }
        });
        return false;
    });


    $('#cars select[name=company]').change(function () {

        $('#cars select[name=model]').parent().find('.select2-chosen').text("");
        var company = $(this).val();
        //alert(category);

        $.ajax({
            type: 'post',
            url: 'ajax/get_model.php',
            data: {
                'company': company
            },
            success: function (data) {
                $('#cars select[name=model]').html(data);
                $('#cars select[name=model]').parent().parent().removeClass('hidden');

            }
        });

    });


    $('#cars select[name=city]').change(function () {

        $('#cars select[name=city]').parent().find('.select2-chosen').text("");
        var city = $(this).val();
        //alert(category);

        $.ajax({
            type: 'post',
            url: 'ajax/get_branch.php',
            data: {
                'city': city
            },
            success: function (data) {
                $('#cars select[name=branch]').html(data);
                $('#cars select[name=branch]').parent().removeClass('hidden');

            }
        });

    });


    $('main form:not(#Promotion)').submit(function (e) {

        var form = $(this);
        var count = 0;
        $(this).find('input.validate').each(function (e) {
            if ($(this).attr('name') === "image") {
                if ($(this).val()) {
                    $(this).parent().find('img').css('border', '1px solid green');
                    $(this).removeClass('off');
                } else {
                    $(this).parent().find('img').css('border', '1px solid red');
                    $(this).addClass('off');
                }
            } else {
                if ($(this).val()) {
                    $(this).css('border-color', 'green');
                    $(this).removeClass('off');
                } else {
                    $(this).css('border-color', 'red');
                    $(this).addClass('off');
                    // console.log($(this).prop("tagName"));
                    count += 1;
                }
            }
        });

        $(this).find('select.validate').each(function (e) {
            if ($(this).val()) {
                $(this).parent().find('div').css('border-color', 'green');
                $(this).removeClass('off');
            } else {
                $(this).parent().find('div').css('border-color', 'red');
                $(this).addClass('off');
                //console.log($(this).prop("tagName"));
            }

        });

        console.log(count);

        if (!$('main form .validate').hasClass('off')) {
            //e.setDefaults();
            form.submit();
            //return true;
        } else {
            e.preventDefault();
        }


    });

    $('main form#Promotion').submit(function (e) {

        var form = $(this);
        var count = 0;
        $(this).find('input.validate').each(function (e) {

            if ($(this).val()) {
                $(this).css('border-color', 'green');
                $(this).removeClass('off');
            } else {
                $(this).css('border-color', 'red');
                $(this).addClass('off');
                count += 1;
            }

        });

        $(this).find('select.validate').each(function (e) {
            if ($(this).val()) {
                $(this).parent().find('div').css('border-color', 'green');
                $(this).removeClass('off');
            } else {
                $(this).parent().find('div').css('border-color', 'red');
                $(this).addClass('off');
                //console.log($(this).prop("tagName"));
            }

        });

        console.log(count);

        if (!$('main form .validate').hasClass('off')) {
            //e.setDefaults();
            form.submit();
            //return true;
        } else {
            e.preventDefault();
        }


    });


    $('select[name=type]').change(function () {
        var id = $(this).val();

        if (id == 1) {
            $('input[name=link]').attr('disabled', true);
            $('input[name=link]').parent().addClass('hidden');
            $('textarea[name=body]').removeAttr('disabled');
            $('textarea[name=body]').parent().parent().parent().removeClass('hidden');

        } else if (id == 2) {
            $('input[name=link]').removeAttr('disabled');
            $('input[name=link]').parent().removeClass('hidden');
            $('textarea[name=body]').attr('disabled', true);
            $('textarea[name=body]').parent().parent().parent().addClass('hidden');
        }
    });


    $('input[name="category[]"]').click(function () {

        if ($(this).prop("checked") == true) {
            $(this).parent().find('input[name="order_category[]"]').removeAttr('disabled');
        }

        else if ($(this).prop("checked") == false) {
            $(this).parent().find('input[name="order_category[]"]').attr('disabled', true);
        }
    });

    $('input[name="page[]"]').click(function () {

        if ($(this).prop("checked") == true) {
            $(this).parent().find('input[name="order_page[]"]').removeAttr('disabled');
        }

        else if ($(this).prop("checked") == false) {
            $(this).parent().find('input[name="order_page[]"]').attr('disabled', true);
        }
    });


});

function printDiv(divID) {
    //Get the HTML of div
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    //Reset the page's HTML with div's HTML only
    document.body.innerHTML =
        "<html><head><title></title></head><body>" +
        divElements + "</body>";

    //Print Page
    window.print();

    //Restore orignal HTML
    document.body.innerHTML = oldPage;


}



          
            
