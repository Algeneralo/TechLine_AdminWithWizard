<?php
$pagesObject = new pages();
$LangsObject = new langs();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $id = $_GET["id"];
    $data = $pagesObject->viewPages("and pages.id = $id");
    $datapost = $data["0"];
}

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة صفحة';
    $s = 'اضافة';
} else if (isset($_GET["action"]) and $_GET['action'] == "update") {
    $l = 'تعديل صفحة';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">الصفحات</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">الصفحات</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form id="manage_pages_form" action="" method="post" enctype="multipart/form-data">
        <?php $pagesObject->EditRecord(); ?>
        <div class="row">
            <div class="col-md-9">
                <!-- Panel Form Elements -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $l ?></h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">اسم الصفحة</h4>
                                    <input type="text" class="form-control round" id="name" name="name"
                                           value="<?php if (isset($datapost["name"])) echo $datapost["name"]; ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>

                        </div>


                    </div>
                </div>
                <!-- End Panel Form Elements -->
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6 text-right">
                                <h3 class="panel-title"> محرر نص</h3>
                            </div>
                            <div class="col-md-6 text-left button-editor">
                                <button id="upload_img" type="button" class="btn btn-sm btn-icon btn-info btn-round"
                                        data-toggle="tooltip"
                                        data-original-title="إضافة صور">
                                    <i class="icon md-notifications-add" aria-hidden="true"></i>
                                    <span class="hidden-sm-down">إضافة صور</span>
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <div class="example">
                              <textarea name="body" id="cke"><?php
                                  if (isset($datapost["body"])) {
                                      echo $datapost["body"];
                                  }
                                  ?></textarea>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
                <!-- Panel Input Groups -->

            </div>
            <div class="col-md-3">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">تفاصيل اضافية</h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <!-- Example Basic -->
                        <div class="example-wrap">


                            <h4 class="example-title">الحالة</h4>
                            <input data-plugin="switchery" data-color="#00897b" name="active"
                                <?php if (isset($datapost["active"]) && $datapost["active"] == 1) {
                                    echo "checked='checked'";
                                } elseif (isset($datapost["active"]) && $datapost["active"] == 0) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                } ?>
                                   value="1" style="display: none;" data-switchery="true" type="checkbox">

                        </div>
                        <!-- End Example Basic -->

                    </div>
                </div>
                <!-- End Panel Input Groups -->

                <!-- Panel Input Groups -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">نشر</h3>
                    </div>

                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <div class="mb-20">
                            <input name="id" id="id" type="hidden"
                                   value="<?php if (isset($datapost["id"])) echo $datapost["id"]; ?>"/>
                            <input type="hidden" name="action" id="action" value="<?php echo $_GET["action"]; ?>"/>
                            <button type="submit" id="submit_news" name="submit_news"
                                    class="btn btn-block btn-primary"><?= $s ?> </button>
                            <a href="index.php?page=view_pages" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>
        </div>
    </form>
</div>

<!-- End Page -->


