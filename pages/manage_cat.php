<?php
$postObject = new category();
$LangsObject = new langs();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $id = $_GET["id"];
    $data = $postObject->viewCat("category.id = $id");
    $datapost = $data["0"];
}

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة تصنيف';
    $s = 'اضافة';
} else if (isset($_GET["action"]) and $_GET['action'] == "update") {
    $l = 'تعديل تصنيف';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">التصنيفات</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">التصنيفات</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form id="manage_cat_form" action="" method="post" enctype="multipart/form-data">
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
                                    <h4 class="example-title">اسم التصنيف</h4>
                                    <input type="text" class="form-control round" id="name" name="name"
                                           value="<?php if (isset($datapost["name"])) echo $datapost["name"]; ?>">
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Example Rounded Input -->
                                <div style="margin-bottom: 10px">
                                    <h4 class="example-title">التصنيف</h4>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">رئيسي</option>
                                        <?php
                                        $dataCat = $postObject->SelectCat();
                                        foreach ($dataCat as $val) {
                                            ?>
                                            <option value="<?= $val['id'] ?>
                                            <?php if
                                            ((isset($_GET['id'])) && $val['id'] == $postObject->GetAttr("parent_id", "category", $_GET['id'])) {
                                                echo "selected";
                                            } ?>"><?= $val['name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- End Example Rounded Input -->
                            </div>
                            <?php /*
                              <div class="col-md-6">
                                  <!-- Example Rounded Input -->
                                  <div style="margin-bottom: 10px">
                                      <h4 class="example-title">اسم التصنيف بالتركية</h4>
                                      <input type="text" class="form-control round" id="name_turkey" name="name_turkey" value="<?php if(isset($datapost["name_turkey"])) echo $datapost["name_turkey"]; ?>">
                                  </div>
                                  <!-- End Example Rounded Input -->
                              </div> 
                              */ ?>
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
                            <!--<div class="example z-marg">
                              <h4 class="example-title">اللغة</h4>
                                  <select class="form-control" name="lang" data-plugin="select2">
                                    <?php /*foreach ($LangsObject->GetAllRecords() as $lang){?>
                                      <option value="<?=$lang['id']?>" <?php if(isset($datapost["lang"])) {if($lang['id']==$datapost["lang"]) {echo "selected";}}  ?> ><?=$lang['name']?></option>
                                      <?php } */ ?>
                                  </select>
                              </div>-->

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


