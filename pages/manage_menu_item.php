<?php
$menuItemObject = new menu_item();
$catObject = new category();
$pageObject = new pages();
$LangsObject = new langs();
$menuObject = new menu();

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
/*if (!empty($id) && $id != 0) {
  $dataMenuItem = $menuItemObject->selectItem();
}*/
if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة قسم أو صفحة';
    $s = 'حفظ';
} else if (isset($_GET["action"]) and $_GET['action'] == "update") {
    $l = 'تعديل قسم أو صفحة';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">عناصر القائمة</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">القوائم</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form action="" method="post" enctype="multipart/form-data">
        <?php $menuItemObject->EditRecord(); ?>
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
                                <div class="example-wrap">
                                    <div class="example z-marg col-md-12">
                                        <h4 class="example-title">القائمة</h4>
                                        <select class="form-control" disabled="" name="menu_id" data-plugin="select2">
                                            <?php foreach ($menuObject->GetAllRecords() as $lang) { ?>
                                                <option value="<?= $lang['id'] ?>" <?php if ($id == $lang['id']) {
                                                    echo "selected";
                                                } ?> ><?= $lang['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <h4 class="example-title">الأقسام</h4>
                                    <div class="checkbox-custom checkbox-primary">
                                        <?php
                                        $catData = $catObject->SelectCat();
                                        $i = 0;
                                        foreach ($catData as $value) {

                                            $SelectCats = $menuItemObject->GetAttrAll($_GET['id'], $value['id'], 0);

                                            ?>
                                            <div>
                                                <div class="col-md-6">
                                                    <input type="checkbox" name="menu_item[]" class="check"
                                                           value="<?= $value['id'] ?> 0 <?= $i ?>"
                                                        <?php
                                                        if ($value['id'] == $SelectCats['m_id']) {
                                                            echo "checked";
                                                        }
                                                        ?>
                                                    />
                                                    <label for="inputUnchecked"><?= $value['title'] ?></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control select_box" name="order_m<?= $i++ ?>"
                                                           type="number" min="1" placeholder="الترتيب"
                                                        <?php
                                                        if ($value['id'] == $SelectCats['m_id']) {
                                                            echo "value='" . $SelectCats['order_m'] . "'";
                                                        } else {
                                                            echo "value='1'" . "disabled";
                                                        }
                                                        ?>
                                                    >
                                                </div>
                                            </div>
                                            <br><br>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <h4 class="example-title">الصفحات</h4>
                                    <div class="checkbox-custom checkbox-primary">
                                        <?php
                                        $catData = $pageObject->SelectPages();
                                        foreach ($catData as $value) {
                                            $SelectPage = $menuItemObject->GetAttrAll($_GET['id'], $value['id'], 1);
                                            ?>
                                            <div>
                                                <div class="col-md-6">
                                                    <input type="checkbox" name="menu_item[]" class="check input-val"
                                                           value="<?= $value['id'] ?> 1 <?= $i ?>"
                                                        <?php
                                                        if ($value['id'] == $SelectPage['m_id']) {
                                                            echo "checked";
                                                        }
                                                        ?>
                                                    />
                                                    <label for="inputUnchecked"><?= $value['name'] ?></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control select_box" name="order_m<?= $i++ ?>"
                                                           min="1" type="number" placeholder="الترتيب"
                                                        <?php
                                                        if ($value['id'] == $SelectPage['m_id']) {
                                                            echo "value='" . $SelectPage['order_m'] . "'";
                                                        } else {
                                                            echo "value='1'" . "disabled";
                                                        }
                                                        ?>
                                                    />
                                                </div>
                                            </div>
                                            <br><br>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                </div>
                                <!-- End Example Rounded Input -->
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
                        <h3 class="panel-title">تفاصيل إضافية</h3>
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


