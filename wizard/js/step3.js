$(".addBtn").on('click', function () {
    let div = $('#cloneable').clone();
    div.removeAttr('id');
    div.find(".addBtn").attr('class', 'removeBtn btn-danger');
    div.find(".fa-plus-circle").addClass('fa-trash').removeClass("fa-plus-circle");
    div.find(".btn-success").addClass('fa-trash-circle').removeClass("fa-plus-circle");
    div.find('input[type="text"]').val("");
    div.find('input[type="checkbox"]').not(':first-of-type').prop('checked', false);
    div.find('input[type="hidden"]').val("0");
    $(".panel-body").append(div);

});
$('body').on('click', '.removeBtn', function (e) {
    e.preventDefault();
    tr = $(this).parent().parent();
    tr.remove();

});
$('body').on('change', 'input[type="checkbox"]', function (e) {

    if ($(this).is(":checked")) {
        $(this).siblings('input').val("1");
    } else {
        $(this).siblings('input').val("0");
    }

});
$("#form").validate({
    rules: {
        "className[]": {
            required: true,
        },
        "type[]": {
            required: true,

        }
    },
    submitHandler: function (form) {
        form.submitHandler();
    }
});
