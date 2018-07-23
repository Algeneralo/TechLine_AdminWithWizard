<?php
$contactObject = new contact();
$data = $contactObject->GetAllRecords();
?>
<!-- Page -->
<form method="POST" action="">
    <div class="page-header">
        <h1 class="page-title">عرض الرسائل</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">الرسائل</a></li>
            <li class="breadcrumb-item active">عرض الرسائل</li>
        </ol>
        <div class="page-header-actions">

            <button type="submit" name='delete_contact' class="btn btn-sm btn-icon btn-danger btn-round"
                    data-toggle="tooltip"
                    data-original-title="حذف المحدد">
                <i class="icon md-delete" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="page-content">
        <?php
        $contactObject->DeleteRecords();
        ?>
        <!-- Panel Table Tools -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">عرض الرسائل</h3>
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
                        <th>الايميل</th>
                        <th>التاريخ</th>
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
                                        <input type="checkbox" name="contact_box[]" id="contact_box" class="checkboxes"
                                               value="<?= $val['id'] ?>"/>
                                        <label for="contact_box"></label>
                                    </div>

                                </td>
                                <td><?= $val['name'] ?></td>
                                <td><?= $val['email'] ?></td>
                                <td><?= $val['date'] ?></td>
                                <td id='status_msg'>
                                    <?php if ($val['active'] == 1) { ?>
                                        <span class="badge badge-success">تم الرد</span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">لم يتم الرد</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                                       data-original-title="رد"
                                       href="index.php?page=manage_contact&action=Update&id=<?= $val['id'] ?>">
                                        <i class="icon md-mail-reply" aria-hidden="true"></i>
                                    </a>

                                    <button type="button"
                                            data-table='contact'
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
