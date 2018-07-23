<?php
$menuObject = new menu();
$LangsObject = new langs();
$CategoryObject = new category();
$PagesObject = new pages();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $data = $menuObject->GetAllRecords($_GET['id']);
    $datamenu = $data[0];

    $menuItem = $menuObject->GetAllRecordsItem($datamenu['id']);
    $dataPageId = "";
    $dataOrderId = "";
    foreach ($menuItem as $row) {
        $dataPageId .= $row['page_id'] . ",";
    }
    $dataPage = explode(',', rtrim($dataPageId));

}

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة قائمة';
    $s = 'نشر';
} else if (isset($_GET["action"]) and $_GET['action'] == "Update") {
    $l = 'تعديل قائمة';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">القوائم</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">القوائم</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form id="manage_menu_form" action="" method="POST" enctype="multipart/form-data">
        <?php $menuObject->EditRecord(); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Panel Form Elements -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">بيانات القائمة</h3>
                            </div>
                            <div class="panel-body container-fluid">
                                <div class="row row-lg">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h4 class="example-title">الاسم</h4>
                                            <input type="text" class="form-control round" id="name" name="name"
                                                   value="<?php if (isset($datamenu["name"])) echo $datamenu["name"]; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Panel Form Elements -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Panel Form Elements -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">التصنيفات</h3>
                            </div>
                            <div class="panel-body container-fluid">
                                <div class="row row-lg">
                                    <div class="col-md-12">
                                        <?php $categoryData = $CategoryObject->GetMenuRecords();
                                        if (!empty($categoryData)) {
                                            foreach ($categoryData as $category) {
                                                if (isset($datamenu['id'])) {
                                                    $arr = $menuObject->GetType($category['id'], $datamenu['id'], 1);
                                                    if (!empty($arr)) {
                                                        $type = $arr[0]['type'];
                                                        $order = $arr[0]['ordered'];
                                                    } else {
                                                        $type = 0;
                                                        $order = 0;
                                                    }
                                                } else {
                                                    $type = 0;
                                                    $order = 0;
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input type="checkbox" <?php if (isset($datamenu['id']) and isset($dataPage) and in_array($category['id'], $dataPage) and $type == 1) echo 'checked'; ?>
                                                               name="category[]"
                                                               id="inputUnchecked<?= $category['id'] ?>"
                                                               value="<?= $category['id'] ?>"/>
                                                        <label for="inputUnchecked<?= $category['id'] ?>"><?= $category['name'] ?></label>
                                                        <input <?php if (isset($datamenu['id']) and isset($dataPage) and in_array($category['id'], $dataPage) and $type == 1) echo ''; else echo 'disabled'; ?>
                                                                type="number" name="order_category[]"
                                                                placeholder="الترتيب" min="0" value="<?= $order ?>"
                                                                class="form-control round menu-input" title="">
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Panel Form Elements -->
                    </div>
                    <div class="col-md-6">
                        <!-- Panel Form Elements -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">الصفحات</h3>
                            </div>
                            <div class="panel-body container-fluid">
                                <div class="row row-lg">
                                    <div class="col-md-12">
                                        <?php $pagesData = $PagesObject->GetAllRecordsForMenu();
                                        if (!empty($pagesData)) {
                                            foreach ($pagesData as $page) {
                                                if (isset($datamenu['id'])) {
                                                    $arr1 = $menuObject->GetType($page['id'], $datamenu['id'], 2);
                                                    if (!empty($arr1)) {
                                                        $type1 = $arr1[0]['type'];
                                                        $order1 = $arr1[0]['ordered'];
                                                    } else {
                                                        $type1 = 0;
                                                        $order1 = 0;
                                                    }
                                                } else {
                                                    $type1 = 0;
                                                    $order1 = 0;
                                                }

                                                ?>
                                                <div class="form-group">
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input type="checkbox" <?php if (isset($datamenu['id']) and isset($dataPage) and in_array($page['id'], $dataPage) and $type1 == 2) echo 'checked'; ?>
                                                               name="page[]" id="inputUnchecked1<?= $page['id'] ?>"
                                                               value="<?= $page['id'] ?>"/>
                                                        <label for="inputUnchecked1<?= $page['id'] ?>"><?= $page['name'] ?></label>
                                                        <input <?php if (isset($datamenu['id']) and isset($dataPage) and in_array($page['id'], $dataPage) and $type1 == 2) echo ''; else echo 'disabled'; ?>
                                                                type="number" name="order_page[]" placeholder="الترتيب"
                                                                min="0" value="<?= $order1 ?>"
                                                                class="form-control round menu-input" title="">
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Panel Form Elements -->
                    </div>
                </div>


            </div>
            <div class="col-md-3">
                <!-- Panel Input Groups -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">مكان القائمة</h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <div class="example z-marg">
                                <select class="form-control" name="place_id" data-plugin="select2">
                                    <option <?php if (isset($datamenu['place_id']) and $datamenu['place_id'] == 1) echo 'selected'; ?>
                                            value="1">القائمة العلوية
                                    </option>
                                    <option <?php if (isset($datamenu['place_id']) and $datamenu['place_id'] == 2) echo 'selected'; ?>
                                            value="2">قائمة الفوتر
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- End Example Basic -->

                    </div>
                </div>
                <!-- End Panel Input Groups -->
                <!-- Panel Input Groups -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">اللغة</h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <!-- Example Basic -->
                        <div class="example-wrap">

                            <h4 class="example-title">التفعيل</h4>
                            <input data-plugin="switchery" data-color="#00897b" name="active"
                                <?php if (isset($datamenu["active"]) && $datamenu["active"] == 1) {
                                    echo "checked='checked'";
                                } elseif (isset($datamenu["active"]) && $datamenu["active"] == 0) {
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
                                   value="<?php if (isset($datamenu["id"])) echo $datamenu["id"]; ?>"/>
                            <input type="hidden" name="action" id="action" value="<?php echo $_GET["action"]; ?>"/>
                            <button type="submit" id="submit_menu" name="submit_menu"
                                    class="btn btn-block btn-primary"><?= $s ?> </button>
                            <a href="index.php?page=view_menu" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>


        </div>
    </form>
</div>

<!-- End Page -->


