<?php
$classObject = new cloneClass();
$LangsObject = new langs();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $data = $classObject->GetRecords($_GET['id']);
    if (!empty($data)) {
        $data = $data["0"];
    }
}
if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $panelName = 'إضافة ....';
    $buttonName = 'اضافة';
} else if (isset($_GET["action"]) and $_GET['action'] == "update") {
    $panelName = 'تعديل ....';
    $buttonName = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">اسم الصفحة</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">اسم الصفحة</a></li>
        <li class="breadcrumb-item active"><?= $panelName ?></li>
    </ol>
</div>

<div class="page-content">
    <form id="manage_cloneClass_form" action="" method="post" enctype="multipart/form-data">
        <?php $classObject->EditRecord(); ?>
        <div class="row">
            <div class="col-md-9">
                <!-- Panel Form Elements -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $panelName ?></h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">الاسم </h4>
                                    <input type="text" class="form-control round" id="name" name="name"
                                           value="<?= $data["name"] ?? '' ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
<!--                            <div class="panel">-->
<!--                                <div class="panel-heading">-->
<!--                                    <h3 class="panel-title">صورة </h3>-->
<!--                                </div>-->
<!--                                <div class="panel-body container-fluid">-->
<!--                                    <div class="example-wrap">-->
<!--                                        <div class="example">-->
<!--                                            <input type="hidden" name="old_image" value="--><?//= $data["image"] ?? '' ?><!--">-->
<!--                                            <input type="file" name="image[]" id="input-file-now" class="dropify"-->
<!--                                                   value="--><?//= $data["image"] ?? '' ?><!--"-->
<!--                                                   data-plugin="dropify"-->
<!--                                                   data-default-file="--><?php //if (isset($data["image"])) echo 'files/media/' . $data["image"]; ?><!--"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>

                    </div>
                </div>
                <!-- End Panel Form Elements -->

                <!-- Panel Input Groups -->

            </div>
            <div class="col-md-3">
                <!-- Panel Input Groups -->

                <!-- End Panel Input Groups -->
                <!-- Panel Input Groups -->
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
                                <?php if (isset($data["active"]) && $data["active"] == 1) {
                                    echo "checked='checked'";
                                } elseif (isset($data["active"]) && $data["active"] == 0) {
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
                                   value="<?= $data["id"] ?? '' ?>"/>
                            <input type="hidden" name="action" id="action" value="<?= $_GET["action"]; ?>"/>
                            <button type="submit" id="submit_cloneClass" name="submit_cloneClass"
                                    class="btn btn-block btn-primary"><?= $buttonName ?> </button>
                            <a href="index.php?page=view_cloneClass" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>


        </div>
    </form>
</div>

<!-- End Page -->


