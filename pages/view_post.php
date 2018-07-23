<?php
$postObject = new post();

$data = isset($_GET['category_id']) ? $postObject->viewPost($_GET['category_id']) : $postObject->GetAllRecords();


?>
<!-- Page -->
<form method="post" action="">
    <div class="page-header">
        <h1 class="page-title">عرض المواضيع</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">المواضيع</a></li>
            <li class="breadcrumb-item active">

            </li>
        </ol>
        <div class="page-header-actions">
            <?php if (isset($_GET['category_id']) and $_GET['category_id'] != 0 and !empty($_GET['category_id'])) { ?>
                <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                   data-original-title="اضافة جديد"
                   href="index.php?page=manage_post&action=insert&category_id=<?= $_GET['category_id'] ?>">
                    <i class="icon md-notifications-add" aria-hidden="true"></i>
                </a>
            <?php } else { ?>
                <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                   data-original-title="اضافة جديد" href="index.php?page=manage_post&action=insert">
                    <i class="icon md-notifications-add" aria-hidden="true"></i>
                </a>
            <?php } ?>
            <button type="submit" name='activate_post' class="btn btn-sm btn-icon btn-success btn-round"
                    data-toggle="tooltip"
                    data-original-title="تفعيل المحدد">
                <i class="icon md-notifications-active" aria-hidden="true"></i>
            </button>
            <button type="submit" name='deactivate_post' class="btn btn-sm btn-icon btn-warning btn-round"
                    data-toggle="tooltip"
                    data-original-title="إلغاء تفعيل المحدد">
                <i class="icon md-notifications-off" aria-hidden="true"></i>
            </button>
            <button type="submit" name='delete_post' class="btn btn-sm btn-icon btn-danger btn-round"
                    data-toggle="tooltip"
                    data-original-title="حذف المحدد">
                <i class="icon md-delete" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="page-content">
        <?php
        $postObject->ActivatedRecords();
        $postObject->DeactivatedRecords();
        $postObject->DeleteRecords();
        ?>
        <!-- Panel Table Tools -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">عرض المواضيع</h3>
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
                        <th>العنوان</th>
                        <th>التصنيف</th>
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
                                        <input type="checkbox" name="post_box[]" value="<?= $val['id'] ?>" id="post_box"
                                               class="checkboxes"/>
                                        <label for="post_box"></label>
                                    </div>
                                </td>
                                <td><?= $val['title'] ?></td>
                                <td><?= $val['cat_title'] ?></td>
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
                                    <?php if (isset($_GET['category_id']) and $_GET['category_id'] != 0 and !empty($_GET['category_id'])) { ?>
                                        <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                                           data-original-title="تعديل"
                                           href="index.php?page=manage_post&action=update&id=<?= $val['id'] ?>&category_id=30">
                                            <i class="icon md-edit" aria-hidden="true"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                                           data-original-title="تعديل"
                                           href="index.php?page=manage_post&action=update&id=<?= $val['id'] ?>">
                                            <i class="icon md-edit" aria-hidden="true"></i>
                                        </a>
                                    <?php } ?>
                                    <button type="button"
                                            data-table="post"
                                            class="btn btn-sm btn-icon <?php if ($val['active'] == 1) echo 'btn-warning'; else echo 'btn-success'; ?>  btn-round active-confirm"
                                            data-message="<?= $val['active'] ?>" data-id="<?= $val['id'] ?>"
                                            data-toggle="tooltip"
                                            data-original-title="<?php if ($val['active'] == 1) echo 'الغاء تفعيل'; else echo 'تفعيل'; ?>">
                                        <i class="icon md-notifications" aria-hidden="true"></i>
                                    </button>
                                    <button type="button"
                                            data-table="post"
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
