<?php
$postObject = new post();
$catObject = new category();
$LangsObject = new langs();
$datapost["category_id"] = 0;
$datapost["lang"] = 0;

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $data = $postObject->GetAllRecords(intval($_GET['id']));
    if (!empty($data)) {
        $datapost = $data["0"];
    }
}
$cat_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة موضوع';
    $s = 'اضافة';
} else if (isset($_GET["action"]) and $_GET['action'] == "update") {
    $l = 'تعديل موضوع';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">المواضيع</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">المواضيع</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form id="manage_post_form" action="" method="post" enctype="multipart/form-data">
        <?php $postObject->EditRecord(); ?>
        <div class="row">
            <div class="col-md-9">
                <!-- Panel Form Elements -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $l ?></h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-md-12">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">العنوان</h4>
                                    <input type="text" class="form-control round" id="title" name="title"
                                           value="<?php if (isset($datapost["title"])) echo $datapost["title"]; ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
                        </div>

                        <div class="row row-lg">
                            <?php
                            if ($cat_id == 30) {
                                ?>
                                <div class="col-md-6">
                                    <!-- Example Rounded Input -->
                                    <div style="margin-bottom: 10px">
                                        <h4 class="example-title">العنوان</h4>
                                        <input class="form-control" type="text" disabled
                                               value="<?= $postObject->GetAttr("name", "category", $cat_id) ?>"/>
                                    </div>
                                    <!-- End Example Rounded Input -->
                                </div>
                                <div class="col-md-6">
                                    <!-- Example Rounded Input -->
                                    <div style="margin-bottom: 10px">
                                        <h4 class="example-title">الرابط</h4>
                                        <input class="form-control" type="text" name="link"
                                               value="<?php if (isset($datapost["image"])) echo $datapost["image"]; ?>"/>
                                    </div>
                                    <!-- End Example Rounded Input -->
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-md-6">
                                    <!-- Example Rounded Input -->
                                    <div style="margin-bottom: 10px">
                                        <h4 class="example-title">القسم</h4>
                                        <?php if (isset($_GET['category_id']) and $_GET['category_id'] != 0 and !empty($_GET['category_id'])) { ?>
                                            <input readonly type="text" class="form-control round" id="" name=""
                                                   value="<?php if (isset($_GET["category_id"])) echo $postObject->GetAttr('name', 'category', $_GET["category_id"]); ?>">
                                            <input readonly type="hidden" class="form-control round" id="category_id"
                                                   name="category_id"
                                                   value="<?php if (isset($_GET["category_id"])) echo $_GET["category_id"]; ?>">

                                        <?php } else { ?>
                                            <select class="form-control" name="category_id" data-plugin="select2">
                                                <?php
                                                $catData = $catObject->SelectCat();

                                                foreach ($catData as $value) {
                                                    if ($value['id'] != 30) {
                                                        ?>
                                                        <option value="<?= $value['id'] ?>" <?php if ($value["id"] == $datapost["category_id"]) echo "selected"; ?>><?= $value['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>

                                    </div>
                                    <!-- End Example Rounded Input -->
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
                <!-- End Panel Form Elements -->

                <!-- Panel Input Groups -->
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6 text-right">
                                <h3 class="panel-title"> التفاصيل</h3>
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
                            <textarea id="cke"
                                      name="details"><?php if (isset($datapost["details"])) echo $datapost["details"]; ?></textarea>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>
            <div class="col-md-3">
                <!-- Panel Input Groups -->

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">صورة بارزة</h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <div class="example-wrap">
                            <!--<h4 class="example-title"></h4>-->
                            <div class="example">
                                <input type="hidden" name="old_image" value="<?= $datapost["image"] ?? '' ?>">
                                <input type="file" name="image[]" id="input-file-now" class="dropify"
                                       value="<?= $datapost["image"] ?? '' ?>"
                                       data-plugin="dropify"
                                       data-default-file="<?php if (isset($datapost["image"])) echo 'files/media/' . $datapost["image"]; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Panel Input Groups -->
                <!-- Panel Input Groups -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
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
                            <a href="index.php?page=view_post" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>


        </div>
    </form>
</div>

<!-- End Page -->


?>
