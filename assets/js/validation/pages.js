$("#manage_cat_form").validate({
    rules: {
        name: {
            required: true,
        }
    },
    submitHandler: function (form) {
        form.submitHandler()
    }
});
$("#manage_users_form").validate({
    rules: {
        username: {
            required: true,
        }, fullname: {
            required: true,
        }, email: {
            required: true,
        }, mobile: {
            required: true,
        }
    },
    submitHandler: function (form) {
        form.submitHandler()
    }
});
$("#manage_config_form").validate({
    rules: {
        site_name: {
            required: true,
        },
        site_owner: {
            required: true,
        },
        site_url: {
            required: true,
        },
        description: {
            required: true,
        },
        image: {
            required: true,
            extension: "png|jpg|jpeg"
        }
    },
    submitHandler: function (form) {
        form.submitHandler()
    }
});

$("#manage_menu_form").validate({
    rules: {
        name: {
            required: true,
        }
    },
    submitHandler: function (form) {
        form.submitHandler()
    }
});

$("#manage_pages_form").validate({
    rules: {
        name: {
            required: true,
        }, body: {
            required: true,
        }
    },
    submitHandler: function (form) {
        form.submitHandler()
    }
});
$("#manage_post_form").validate({
    rules: {
        title: {
            required: true,
        }, details: {
            required: true,
        }, image: {
            required: true,
            extension: "png|jpg|jpeg"
        }
    },
    submitHandler: function (form) {
        form.submitHandler()
    }
});
$("#manage_profile_form").validate({
    rules: {
        fullname: {
            required: true,
        }, username: {
            required: true,
        }, image: {
            extension: "png|jpg|jpeg"
        }, mobile: {
            required: true,
        }
    },
    submitHandler: function (form) {
        form.submitHandler()
    }
});