<?php

require_once('includes/require.class.php');
//check wizard step value ,then assigned it to session
$step_count = file_get_contents("wizard/step_value.txt");
$_SESSION['step'] = 1;
if (!empty(trim($step_count))) {
    $_SESSION['step'] = trim($step_count);
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>TechlineCo. investment & IT</title>

    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="global/css/bootstrap.min.css">
    <link rel="stylesheet" href="global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="assets/css/site.min.css">
    <link rel="stylesheet" href="assets/css/validation.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="global/vendor/waves/waves.css">
    <link rel="stylesheet" href="global/vendor/chartist/chartist.css">
    <link rel="stylesheet" href="global/vendor/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
    <link rel="stylesheet" href="assets/examples/css/tables/datatable.css">
    <!--<link rel="stylesheet" href="assets/examples/css/dashboard/v1.css">-->


    <link rel="stylesheet" href="global/vendor/select2/select2.css">
    <link rel="stylesheet" href="global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="global/vendor/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="global/vendor/icheck/icheck.css">
    <link rel="stylesheet" href="global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="global/vendor/asrange/asRange.css">
    <link rel="stylesheet" href="global/vendor/ionrangeslider/ionrangeslider.min.css">
    <link rel="stylesheet" href="global/vendor/asspinner/asSpinner.css">
    <link rel="stylesheet" href="global/vendor/clockpicker/clockpicker.css">
    <link rel="stylesheet" href="global/vendor/ascolorpicker/asColorPicker.css">
    <link rel="stylesheet" href="global/vendor/bootstrap-touchspin/bootstrap-touchspin.css">
    <link rel="stylesheet" href="global/vendor/jquery-labelauty/jquery-labelauty.css">
    <link rel="stylesheet" href="global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
    <link rel="stylesheet" href="global/vendor/timepicker/jquery-timepicker.css">
    <link rel="stylesheet" href="global/vendor/jquery-strength/jquery-strength.css">
    <link rel="stylesheet" href="global/vendor/multi-select/multi-select.css">
    <link rel="stylesheet" href="global/vendor/typeahead-js/typeahead.css">
    <link rel="stylesheet" href="assets/examples/css/forms/advanced.css">
    <link rel="stylesheet" href="global/vendor/bootstrap-markdown/bootstrap-markdown.css">
    <link rel="stylesheet" href="global/fonts/font-awesome/font-awesome.min.css">


    <!-- Plugins -->
    <link rel="stylesheet" href="global/vendor/blueimp-file-upload/jquery.fileupload.css">
    <link rel="stylesheet" href="global/vendor/dropify/dropify.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!-- Bootstrap RTl for directions -->
    <link rel="stylesheet" href="global/css/bootstrap-rtl.min.css"/>
    <!-- custom RTl for directions -->
    <link rel="stylesheet" href="global/css/custom-rtl.css"/>
    <link rel="stylesheet" href="global/css/rtl.css"/>

    <!--[if lt IE 9]>
    <script src="global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="global/vendor/media-match/media.match.min.js"></script>
    <script src="global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="global/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
    <script src="global/vendor/jquery/jquery.js"></script>

</head>
<body class="animsition site-navbar-small dashboard">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <a class="navbar-brand navbar-brand-center" href="#">
            <img class="navbar-brand-logo navbar-brand-logo-normal"
                 src="wizard/Techline_logo.png"
                 title="Techline">
            <img class="navbar-brand-logo navbar-brand-logo-special"
                 src="wizard/Techline_logo.png"
                 title="Remark">
            <span class="navbar-brand-text hidden-xs-down">TechLine</span>
        </a>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon md-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item hidden-float">
                    <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">

                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
                                <span class="avatar avatar-online">
                                    <img src="global/portraits/myPic.jpg" alt="...">
                                    <i></i>
                                </span>
                    </a>
                    <div class="dropdown-menu" role="menu">

                        <a class="dropdown-item" href="#" role="menuitem"><i class="icon md-settings"
                                                                             aria-hidden="true"></i>
                            الاعدادت</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" role="menuitem"><i class="icon md-power"
                                                                             aria-hidden="true"></i>
                            تسجيل خروج</a>
                    </div>
                </li>
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>

            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon md-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
<div class="m-2" style="margin-bottom: 30px !important;">
    <ul class="nav nav-pills nav-wizard">
        <li class="nav-item">
            <a class="nav-link
            <?php if (intval($_SESSION['step']) == 1) echo 'active';
            elseif (intval($_SESSION['step']) > 1) echo 'success'; ?>" href="#">اضافة مستخدم</a>
        </li>
        <li class="nav-item">
            <a class="nav-link
            <?php if (intval($_SESSION['step']) == 2) echo 'active';
            elseif (intval($_SESSION['step']) > 2) echo 'success'; ?>" href="#">اضافة قاعدة البيانات</a>
        </li>
        <li class="nav-item">
            <a class="nav-link
            <?php if (intval($_SESSION['step']) == 3) echo 'active';
            elseif (intval($_SESSION['step']) > 3) echo 'success'; ?>" href="#">اضافة classes</a>
        </li>
    </ul>
</div>
<?php
if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <button data-dismiss="alert" class="close m" type="button">×</button>
        <?= $_SESSION['error'];
        unset($_SESSION['error']) ?>
    </div>
<?php elseif (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <button data-dismiss="alert" class="close m" type="button">×</button>
        <?= $_SESSION['success'];
        unset($_SESSION['success']) ?>
    </div>
<?php endif; ?>
<!-- Page -->

<?php
try{
    __load_wizard();
}catch(\Exception $ex){
    echo "<pre>";
    var_dump($ex);
    echo "</pre>";
}
?>

?>


<!-- End Page -->


<!-- Footer -->
<footer class="site-footer">
    <div class="site-footer-legal">© 2018 <a href="https://techlineco.com">TechLine.</a></div>
    <div class="site-footer-right">
        Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://techlineco.com">TechLine | Connect,
            Integrate & Innovate.</a>
    </div>
</footer>


</body>
<!-- Core  -->
<script src="global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="global/vendor/popper-js/umd/popper.min.js"></script>
<script src="global/vendor/bootstrap/bootstrap.js"></script>
<script src="global/vendor/animsition/animsition.js"></script>
<script src="global/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="global/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="global/vendor/waves/waves.js"></script>

<!-- Plugins -->
<script src="global/vendor/switchery/switchery.js"></script>
<script src="global/vendor/intro-js/intro.js"></script>
<script src="global/vendor/screenfull/screenfull.js"></script>
<script src="global/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="global/vendor/chartist/chartist.min.js"></script>
<script src="global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js"></script>
<script src="global/vendor/jvectormap/jquery-jvectormap.min.js"></script>
<script src="global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<script src="global/vendor/matchheight/jquery.matchHeight-min.js"></script>
<script src="global/vendor/peity/jquery.peity.min.js"></script>

<script src="global/vendor/datatables.net/jquery.dataTables.js"></script>
<script src="global/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="global/vendor/datatables.net-buttons/dataTables.buttons.js"></script>
<script src="global/vendor/datatables.net-buttons/buttons.html5.js"></script>
<script src="global/vendor/datatables.net-buttons/buttons.flash.js"></script>
<script src="global/vendor/datatables.net-buttons/buttons.print.js"></script>
<script src="global/vendor/datatables.net-buttons/buttons.colVis.js"></script>
<script src="global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js"></script>


<script src="global/vendor/blueimp-tmpl/tmpl.js"></script>
<script src="global/vendor/blueimp-canvas-to-blob/canvas-to-blob.js"></script>
<script src="global/vendor/blueimp-load-image/load-image.all.min.js"></script>
<script src="global/vendor/blueimp-file-upload/vendor/jquery.ui.widget.js"></script>
<script src="global/vendor/blueimp-file-upload/jquery.fileupload.js"></script>
<script src="global/vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
<script src="global/vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
<script src="global/vendor/blueimp-file-upload/jquery.fileupload-audio.js"></script>
<script src="global/vendor/blueimp-file-upload/jquery.fileupload-video.js"></script>
<script src="global/vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
<script src="global/vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
<script src="global/vendor/dropify/dropify.min.js"></script>

<!-- Scripts -->
<script src="global/js/Component.js"></script>
<script src="global/js/Plugin.js"></script>
<script src="global/js/Base.js"></script>
<script src="global/js/Config.js"></script>

<script src="assets/js/Section/Menubar.js"></script>
<script src="assets/js/Section/Sidebar.js"></script>
<script src="assets/js/Section/PageAside.js"></script>
<script src="assets/js/Plugin/menu.js"></script>

<!-- Config -->
<script src="global/js/config/colors.js"></script>
<script src="assets/js/config/tour.js"></script>
<script>Config.set('assets', 'assets');</script>

<!-- Page -->
<script src="assets/js/Site.js"></script>
<script src="global/js/Plugin/asscrollable.js"></script>
<script src="global/js/Plugin/slidepanel.js"></script>
<script src="global/js/Plugin/switchery.js"></script>
<script src="global/js/Plugin/matchheight.js"></script>
<script src="global/js/Plugin/jvectormap.js"></script>
<script src="global/js/Plugin/peity.js"></script>
<script src="global/js/Plugin/datatables.js"></script>
<script src="global/js/Plugin/jquery-wizard.js"></script>
<!--<script src="assets/examples/js/tables/datatable.js"></script>-->


<script src="global/js/Plugin/dropify.js"></script>
<script src="global/vendor/select2/select2.full.min.js"></script>
<script src="global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
<script src="global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="global/vendor/bootstrap-select/bootstrap-select.js"></script>
<script src="global/vendor/icheck/icheck.min.js"></script>
<script src="global/vendor/switchery/switchery.js"></script>
<script src="global/vendor/asrange/jquery-asRange.min.js"></script>
<script src="global/vendor/ionrangeslider/ion.rangeSlider.min.js"></script>
<script src="global/vendor/asspinner/jquery-asSpinner.min.js"></script>
<script src="global/vendor/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="global/vendor/ascolor/jquery-asColor.min.js"></script>
<script src="global/vendor/asgradient/jquery-asGradient.min.js"></script>
<script src="global/vendor/ascolorpicker/jquery-asColorPicker.min.js"></script>
<script src="global/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="global/vendor/jquery-knob/jquery.knob.js"></script>
<script src="global/vendor/bootstrap-touchspin/bootstrap-touchspin.min.js"></script>
<script src="global/vendor/jquery-labelauty/jquery-labelauty.js"></script>
<script src="global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="global/vendor/timepicker/jquery.timepicker.min.js"></script>
<script src="global/vendor/datepair/datepair.min.js"></script>
<script src="global/vendor/datepair/jquery.datepair.min.js"></script>
<script src="global/vendor/jquery-strength/password_strength.js"></script>
<script src="global/vendor/jquery-strength/jquery-strength.min.js"></script>
<script src="global/vendor/multi-select/jquery.multi-select.js"></script>
<script src="global/vendor/typeahead-js/bloodhound.min.js"></script>
<script src="global/vendor/typeahead-js/typeahead.jquery.min.js"></script>
<script src="global/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<script src="assets/examples/js/forms/uploads.js"></script>
<script src="global/js/Plugin/select2.js"></script>
<script src="global/js/Plugin/bootstrap-tokenfield.js"></script>
<script src="global/js/Plugin/bootstrap-tagsinput.js"></script>
<script src="global/js/Plugin/bootstrap-select.js"></script>
<script src="global/js/Plugin/icheck.js"></script>
<script src="global/js/Plugin/switchery.js"></script>
<script src="global/js/Plugin/asrange.js"></script>
<script src="global/js/Plugin/ionrangeslider.js"></script>
<script src="global/js/Plugin/asspinner.js"></script>
<script src="global/js/Plugin/clockpicker.js"></script>
<script src="global/js/Plugin/ascolorpicker.js"></script>
<script src="global/js/Plugin/bootstrap-maxlength.js"></script>
<script src="global/js/Plugin/jquery-knob.js"></script>
<script src="global/js/Plugin/bootstrap-touchspin.js"></script>
<script src="global/js/Plugin/card.js"></script>
<script src="global/js/Plugin/jquery-labelauty.js"></script>
<script src="global/js/Plugin/bootstrap-datepicker.js"></script>
<script src="global/js/Plugin/jt-timepicker.js"></script>
<script src="global/js/Plugin/datepair.js"></script>
<script src="global/js/Plugin/jquery-strength.js"></script>
<script src="global/js/Plugin/multi-select.js"></script>
<script src="global/js/Plugin/jquery-placeholder.js"></script>
<script src="global/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
<script src="global/vendor/marked/marked.js"></script>
<script src="global/vendor/to-markdown/to-markdown.js"></script>
<script src="assets/examples/js/forms/advanced.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<!--<script src="assets/js/custom.js"></script>-->
<script src="assets/js/upload.js"></script>
<!--custom validation plugin-->
<script src="assets/js/validation/ar_lang.js"></script>
<script src="assets/js/validation/jquery.validate.js"></script>
<script src="assets/js/validation/additional-methods.js"></script>

<?php
if (isset($_SESSION['step']) && is_file("wizard/js/step{$_SESSION['step']}.js")):?>
    <script src="wizard/js/step<?= $_SESSION['step'] ?>.js"></script>
<?php endif; ?>
<!--<script src="assets/examples/js/dashboard/v1.js"></script>-->

<script>
    (function (document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function () {
            Site.run();
        });
    })(document, window, jQuery);

</script>

</html>
