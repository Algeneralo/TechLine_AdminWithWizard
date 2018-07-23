<?php
$configObject = new config();
$data = $configObject->GetAllRecords();
?>
<!-- Page -->
<form method="POST" action="">
    <div class="page-header">
        <h1 class="page-title">عرض الإعدادات</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">الإعدادات</a></li>
            <li class="breadcrumb-item active">عرض الإعدادات</li>
        </ol>
        <div class="page-header-actions">
        </div>
    </div>

    <div class="page-content">
        <!-- Panel Table Tools -->
        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">عرض الإعدادات</h3>
            </header>

            <div class="panel-body">
                <table class="table table-hover dataTable table-striped table-bordered w-full" id="exampleTableTools">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>اسم الموقع</th>
                        <th>اللغة</th>
                        <th>المستخدم</th>
                        <th class="text-center">التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($data)) { ?>
                        <tr class="text-center">
                            <td colspan="6">لا يوجد بيانات لعرضها</td>
                        </tr>
                    <?php } else {
                        $i = 1;
                        foreach ($data as $val) { ?>
                            <tr>
                                <td>
                                    <?= ($i++) ?>
                                </td>
                                <td><?= $val['site_name'] ?></td>
                                <td><?= $val['lang_name'] ?></td>
                                <td><?= $val['user_name'] ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
                                       data-original-title="تعديل"
                                       href="index.php?page=manage_config&action=Update&id=<?= $val['id'] ?>">
                                        <i class="icon md-edit" aria-hidden="true"></i>
                                    </a>
                                    <!--<button type="button"  class="btn btn-sm btn-icon <?php /*if($val['active'] == 1 ) echo 'btn-warning'; else echo 'btn-success'; */ ?>  btn-round active-confirm" data-message="<? /*=$val['active']*/ ?>" data-id="<? /*=$val['id']*/ ?>" data-toggle="tooltip"
                              data-original-title="<?php /*if($val['active'] == 1 ) echo 'الغاء تفعيل'; else echo 'تفعيل';*/ ?>">
                          <i class="icon md-notifications" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-icon btn-danger btn-round delete-confirm" data-message='حذف' data-id="<? /*=$val['id']*/ ?>" data-toggle="tooltip"
                              data-original-title="حذف ">
                          <i class="icon md-delete" aria-hidden="true"></i>
                      </button>-->
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
