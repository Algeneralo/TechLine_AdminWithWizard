<?php
$pageObject = new pages();
$data = $pageObject->viewPages();

?>
<!-- Page -->
<form method="post" action="">
    <div class="page-header">
        <h1 class="page-title">عرض الصفحات</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">الصفحات</a></li>
            <li class="breadcrumb-item active">عرض الصفحات</li>
        </ol>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
               data-original-title="اضافة جديد" href="index.php?page=manage_pages&action=insert">
                <i class="icon md-notifications-add" aria-hidden="true"></i>
            </a>
            <button type="submit" name='activate_cat' class="btn btn-sm btn-icon btn-success btn-round"
                    data-toggle="tooltip"
                    data-original-title="تفعيل المحدد">
                <i class="icon md-notifications-active" aria-hidden="true"></i>
            </button>
            <button type="submit" name='deactivate_cat' class="btn btn-sm btn-icon btn-warning btn-round"
                    data-toggle="tooltip"
                    data-original-title="إلغاء تفعيل المحدد">
                <i class="icon md-notifications-off" aria-hidden="true"></i>
            </button>
            <button type="submit" name='delete_cat' class="btn btn-sm btn-icon btn-danger btn-round"
                    data-toggle="tooltip"
                    data-original-title="حذف المحدد">
                <i class="icon md-delete" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="page-content">
        <?php
        $pageObject->ActivatedRecords();
        $pageObject->DeactivatedRecords();
        $pageObject->DeleteRecords();
        ?>
        <!-- Panel Table Tools -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">عرض الصفحات</h3>
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
                        <th>اسم الصفحة</th>
                        <th>اسم المستخدم</th>
                        <th>الحالة</th>
                        <th class="text-center">التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($data)) { ?>
                        <tr class="text-center">
                            <td colspan="6">لا يوجد بيانات لعرضها</td>
                        </tr>
                    <?php } else {
                        foreach ($data as $val) { ?>
                            <tr>
                                <td>
                                    <div class="checkbox-custom checkbox-primary">
                                        <input type="checkbox" name="cat_box[]" id="cat_box" class="checkboxes"
                                               value="<?= $val['id'] ?>"/>
                                        <label for="cat_box"></label>
                                    </div>
                                </td>
                                <td><?= $val['name'] ?></td>
                                <td><?= $val['user_name'] ?></td>
                                <td>
                                    <?php
                                    if ($val['active'] == 0) {
                                        echo "<span class='badge badge-danger'>غير مفعل</span>";
                                    } else {
                                        echo "<span class='badge badge-success'>مفعل</span>";
                                    }
                                    ?>
                                </td>


                                <td class="text-center">
                                    <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                                       data-original-title="تعديل"
                                       href="index.php?page=manage_pages&action=update&id=<?= $val['id'] ?>">
                                        <i class="icon md-edit" aria-hidden="true"></i>
                                    </a>
                                    <button type="button"
                                            data-table="pages"
                                            class="btn btn-sm btn-icon <?php if ($val['active'] == 1) echo 'btn-warning'; else echo 'btn-success'; ?>  btn-round active-confirm"
                                            data-message="<?= $val['active'] ?>" data-id="<?= $val['id'] ?>"
                                            data-toggle="tooltip"
                                            data-original-title="<?php if ($val['active'] == 1) echo 'الغاء تفعيل'; else echo 'تفعيل'; ?>">
                                        <i class="icon md-notifications" aria-hidden="true"></i>
                                    </button>
                                    <button type="button"
                                            data-table="pages"
                                            class="btn btn-sm btn-icon btn-danger btn-round delete-confirm"
                                            data-message='حذف' data-id="<?= $val['id'] ?>" data-toggle="tooltip"
                                            data-original-title="حذف ">
                                        <i class="icon md-delete" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php }
                    } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Panel Table Tools -->

    </div>
    <!-- End Page -->
</form>
