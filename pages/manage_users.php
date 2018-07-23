<?php
$postObject = new users();
$LangsObject = new langs();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $id = $_GET["id"];
    $data = $postObject->getUsers("id = $id");
    $datapost = $data["0"];
}

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة عضو';
    $s = 'اضافة';
} else if (isset($_GET["action"]) and $_GET['action'] == "update") {
    $l = 'تعديل عضو';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">الأعضاء</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">الأعضاء</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form id="manage_users_form" action="" method="post" enctype="multipart/form-data">
        <?php $postObject->EditRecord(); ?>
        <div class="row">
            <div class="col-md-9">
                <!-- Panel Form Elements -->
                <input type="hidden" name="old_email" value="<?= $datapost["email"] ?? '' ?>">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $l ?></h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">اسم المستخدم</h4>
                                    <input type="text" class="form-control round" id="username" name="username"
                                           value="<?= $datapost["username"] ?? '' ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">الاسم كامل</h4>
                                    <input type="text" class="form-control round" id="fullname" name="fullname"
                                           value="<?= $datapost["fullname"] ?? '' ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">الايميل</h4>
                                    <input type="email" class="form-control round" id="email" name="email"
                                           value="<?= $datapost["email"] ?? '' ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">الجوال</h4>
                                    <input type="number" class="form-control round" id="mobile" name="mobile"
                                           value="<?= $datapost["mobile"] ?? '' ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">كلمة المرور</h4>
                                    <input type="password" class="form-control round" id="password" name="password"
                                           value="">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>

                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">صورة بارزة</h3>
                            </div>
                            <div class="panel-body container-fluid">
                                <input type="hidden" name="old_image" value="<?= $datapost["image"] ?? '' ?>">
                                <!-- Example Default -->
                                <div class="example-wrap">
                                    <!--<h4 class="example-title"></h4>-->
                                    <div class="example">
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?? '' ?>">
                                        <input type="file" name="image[]" id="input-file-now" class="dropify"
                                               value="<?= $datapost["image"] ?? '' ?>"
                                               data-plugin="dropify"
                                               data-default-file="<?php if (isset($datapost["image"])) echo 'files/media/' . $datapost["image"]; ?>"/>
                                    </div>
                                </div>
                            </div>
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
                            <input type="hidden" name="action" id="action" value="<?= $_GET["action"] ?? 'insert' ?>"/>
                            <button type="submit" id="submit_users" name="submit_users"
                                    class="btn btn-block btn-primary"><?= $s ?> </button>
                            <a href="index.php?page=view_users" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>


        </div>
    </form>
</div>

<!-- End Page -->


