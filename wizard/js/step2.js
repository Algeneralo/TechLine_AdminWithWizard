$("#form").validate({
    rules: {
        username: {
            required: true,
        },
        dbName: {
            required: true,
        }
    },
    submitHandler: function (form) {
        addDBData()
    }
});

function addDBData() {
    $.ajax({
        url: 'wizard/ajax.php',
        type: 'POST',

        data: {
            'username': $('#username').val(),
            'password': $('#password').val(),
            'dbName': $('#dbName').val(),
        },

        success: function (data) { //alert(data);
            console.log(data);
            if (data == 'true') {
                location.reload();
                location.reload();
            } else {
                alert("الرجاء التاكد من ان الحساب او قاعدة البيانات غير موجودين");
            }
        }, error: function (data) {
            console.log('error')
            // c
        }
    });
}