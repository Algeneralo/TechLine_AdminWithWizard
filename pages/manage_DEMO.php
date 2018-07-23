<?php
$postObject = new DEMO();
$LangsObject = new langs();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $id = $_GET["id"];

}

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة DEMO';
    $s = 'اضافة';
} else if (isset($_GET["action"]) and $_GET['action'] == "update") {
    $l = 'تعديل DEMO';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">DEMO</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">DEMO</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form id="manage_DEMO_form" action="" method="post" enctype="multipart/form-data">
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
                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">الاسم</h4>
                                    <input type="text" class="form-control round" id="name" name="name" value="">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">الاسم</h4>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">الاسم</option>
                                        <?php

                                        foreach ($postObject as $val) {
                                            ?>
                                            <option value="<?= $val['id'] ?> <?php if ($val['id'] == $postObject->GetAttr("parent_id", "category", $_GET['id'])) {
                                                echo "selected";
                                            } ?>"><?= $val['name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Panel Form Elements -->

                <!-- Panel Input Groups -->
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
                            <input type="hidden" name="action" id="action" value="<?php echo $_GET["action"]; ?>"/>
                            <button type="submit" id="submit_news" name="submit_news"
                                    class="btn btn-block btn-primary"><?= $s ?> </button>
                            <a href="index.php?page=view_DEMO" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>


        </div>
    </form>
</div>

<!-- End Page -->


