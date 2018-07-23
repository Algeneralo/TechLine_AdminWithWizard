$("#form").validate({
    rules: {
        username: {
            required: true,
        }, fullName: {
            required: true,
        },
        password: {
            required: true,
        },
        passwordConfirm: {
            required: true,
            equalTo: "#password"
        },
        email: {
            required: true,
            email: true,
        }
    },
    submitHandler: function (form) {
        form.submit();
    }
});