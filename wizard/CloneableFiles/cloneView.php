<?php
$classObject = new cloneClass();
$data = $classObject->GetRecords();

?>
<!-- Page -->
<form method="post" action="">
    <div class="page-header">
        <h1 class="page-title">عرض صفحة</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">صفحة</a></li>
            <li class="breadcrumb-item active">عرض صفحة</li>
        </ol>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
               data-original-title="اضافة جديد" href="index.php?page=manage_cloneClass&action=insert">
                <i class="icon md-notifications-add" aria-hidden="true"></i>
            </a>
            <button type="submit" name='activate_cloneClass' class="btn btn-sm btn-icon btn-success btn-round"
                    data-toggle="tooltip"
                    data-original-title="تفعيل المحدد">
                <i class="icon md-notifications-active" aria-hidden="true"></i>
            </button>
            <button type="submit" name='deactivate_cloneClass' class="btn btn-sm btn-icon btn-warning btn-round"
                    data-toggle="tooltip"
                    data-original-title="إلغاء تفعيل المحدد">
                <i class="icon md-notifications-off" aria-hidden="true"></i>
            </button>
            <button type="submit" name='delete_cloneClass' class="btn btn-sm btn-icon btn-danger btn-round"
                    data-toggle="tooltip"
                    data-original-title="حذف المحدد">
                <i class="icon md-delete" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="page-content">
        <?php
        $classObject->ActivatedRecords();
        $classObject->DeactivatedRecords();
        $classObject->DeleteRecords();
        ?>
        <!-- Panel Table Tools -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">عرض صفحة</h3>
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
                        <th>الاسم</th>
                        <th>الحالة</th>

                        <th class="text-center">التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($data)) { ?>
                        <tr class="text-center">
                            <td colspan="4">لا يوجد بيانات لعرضها</td>
                        </tr>
                    <?php } else {
                        foreach ($data as $datum) { ?>
                            <tr>
                                <td>
                                    <div class="checkbox-custom checkbox-primary">
                                        <input type="checkbox" name="cloneClass_box[]" value="<?= $datum['id'] ?>"
                                               class="checkboxes"/>
                                    </div>
                                </td>
                                <td><?= $datum['name'] ?></td>
                                <td>
                                    <?= $datum['active'] == 0 ?
                                        "<span class='badge badge-danger'>غير مفعل</span>"
                                        : "<span class='badge badge-success'>مفعل</span>"
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                                       data-original-title="تعديل"
                                       href="index.php?page=manage_cloneClass&action=update&id=<?= $datum['id'] ?>">
                                        <i class="icon md-edit" aria-hidden="true"></i>
                                    </a>
                                    <button type="button"
                                            data-table="category"
                                            class="btn btn-sm btn-icon <?= $datum['active'] == 1 ? 'btn-warning' : 'btn-success' ?>  btn-round active-confirm"
                                            data-message="<?= $datum['active'] ?>" data-id="<?= $datum['id'] ?>"
                                            data-toggle="tooltip"
                                            data-original-title="<?= $datum['active'] == 1 ? 'الغاء تفعيل' : 'تفعيل' ?>">
                                        <i class="icon md-notifications" aria-hidden="true"></i>
                                    </button>
                                    <?php
//                                    if ($datum['type'] == 0):?>
                                        <button type="button"
                                                data-table="category"
                                                class="btn btn-sm btn-icon btn-danger btn-round delete-confirm"
                                                data-message='حذف' data-id="<?= $datum['id'] ?>" data-toggle="tooltip"
                                                data-original-title="حذف ">
                                            <i class="icon md-delete" aria-hidden="true"></i>
                                        </button>
<!--                                    --><?php //endif; ?>
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
