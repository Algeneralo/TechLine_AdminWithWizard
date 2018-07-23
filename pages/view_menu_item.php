<?php
$menuItemObject = new menu_item();
//$data = $menuItemObject->ViewMenuItemCats();
//$data1 = $menuItemObject->ViewMenuItemPages();

//$dataMenu = $menuItemObject->GetMenuItem();
?>
<!-- Page -->
<form method="post" action="">
    <div class="page-header">
        <h1 class="page-title">عرض عناصر القائمة</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">عناصر القائمة</a></li>
            <li class="breadcrumb-item active">عرض عناصر القائمة</li>
        </ol>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
               data-original-title="اضافة جديد" href="index.php?page=manage_menu_item&action=insert">
                <i class="icon md-notifications-add" aria-hidden="true"></i>
            </a>
            <button type="submit" name='activate_news' class="btn btn-sm btn-icon btn-success btn-round"
                    data-toggle="tooltip"
                    data-original-title="تفعيل المحدد">
                <i class="icon md-notifications-active" aria-hidden="true"></i>
            </button>
            <button type="submit" name='deactivate_news' class="btn btn-sm btn-icon btn-warning btn-round"
                    data-toggle="tooltip"
                    data-original-title="إلغاء تفعيل المحدد">
                <i class="icon md-notifications-off" aria-hidden="true"></i>
            </button>
            <button type="submit" name='delete_news' class="btn btn-sm btn-icon btn-danger btn-round"
                    data-toggle="tooltip"
                    data-original-title="حذف المحدد">
                <i class="icon md-delete" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="page-content">
        <?php
        $menuItemObject->ActivatedRecords();
        $menuItemObject->DeactivatedRecords();
        $menuItemObject->DeleteRecords();
        ?>
        <!-- Panel Table Tools -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">عرض عناصر القائمة</h3>
            </header>

            <div class="panel-body">
                <table class="table table-hover dataTable table-striped table-bordered w-full" id="exampleTableTools">
                    <thead>
                    <tr>
                        <th>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="inputUnchecked" class="group-checkable"/>
                                <label for="inputUnchecked"></label>
                            </div>
                        </th>
                        <th>القائمة</th>
                        <th>قائمة أو صفحة</th>
                        <th>الاسم</th>
                        <th class="text-center">التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($dataMenu)){ ?>
                        <tr class="text-center">
                            <td colspan="6">لا يوجد بيانات لعرضها</td>
                        </tr>
                    <?php }else{
                    foreach ($dataMenu

                    as $val) { ?>
                    <tr>
                        <td>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" name="news_box[]" value="<?= $val['id'] ?>" id="news_box"
                                       class="checkboxes"/>
                                <label for="news_box"></label>
                            </div>
                        </td>
                        <td><?= $val['menu_name'] ?></td>
                        <td>
                            <?php
                            if ($val['type'] == 0) {
                                echo "قسم";
                            } else {
                                echo "صفحة";
                            }
                            ?>
                        </td>
                        <td><?php if ($val['type'] == 0) {
                                echo $menuItemObject->GetAttr('title', 'category', $val['m_id']);
                            } else {

                                echo $menuItemObject->GetAttr('name', 'page', $val['m_id']);
                            } ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                               data-original-title="تعديل"
                               href="index.php?page=manage_menu_item&action=update&id=<?= $val['id'] ?>">
                                <i class="icon md-edit" aria-hidden="true"></i>
                            </a>
                            <button type="button"
                                    class="btn btn-sm btn-icon <?php if ($val['active'] == 1) echo 'btn-warning'; else echo 'btn-success'; ?>  btn-round active-confirm"
                                    data-message="<?= $val['active'] ?>" data-id="<?= $val['id'] ?>"
                                    data-toggle="tooltip"
                                    data-original-title="<?php if ($val['active'] == 1) echo 'الغاء تفعيل'; else echo 'تفعيل'; ?>">
                                <i class="icon md-notifications" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-danger btn-round delete-confirm"
                                    data-message='حذف' data-id="<?= $val['id'] ?>" data-toggle="tooltip"
                                    data-original-title="حذف ">
                                <i class="icon md-delete" aria-hidden="true"></i>
                            </button>
                        </td>
                        <?php }
                        } ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Panel Table Tools -->

    </div>
    <!-- End Page -->
</form>

<div class='modal fade modal-fade-in-scale-up' id='myModal' data-table='menu_item'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <a href='#' data-dismiss='modal' aria-hidden='true' class='close'>×</a>
                <h3></h3>
            </div>
            <div class='modal-body'>
                <p></p>
            </div>
            <div class='modal-footer'>
                <button type="button" id='btnYes' class="btn btn-success waves-effect waves-classic">نعم</button>
                <button type="button" class="btn btn-danger waves-effect waves-classic" data-dismiss="modal">إلغاء
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class='modal fade modal-fade-in-scale-up' id='delModal' data-table='menu_item'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <a href='#' data-dismiss='modal' aria-hidden='true' class='close'>×</a>
                <h3></h3>
            </div>
            <div class='modal-body'>
                <p></p>
            </div>
            <div class='modal-footer'>
                <button type="button" id='btnYes1' class="btn btn-success waves-effect waves-classic">نعم</button>
                <button type="button" class="btn btn-danger waves-effect waves-classic" data-dismiss="modal">إلغاء
                </button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>