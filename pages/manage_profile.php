<?php
$usersObject = new users();
$data = $usersObject->getUsers('id=' . $_SESSION['User_ID'])[0];
?>
<!-- Page -->
<form id="manage_profile_form" method="post" action="" enctype="multipart/form-data">
    <?php $usersObject->EditRecord(); ?>
    <div class="page-header">
        <h1 class="page-title">البروفايل</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">البروفايل</a></li>
            <li class="breadcrumb-item active">عرض البروفايل</li>
        </ol>
    </div>

    <div class="page-content">
        <!-- Panel Table Tools -->
        <div class="row">
            <div class="col-md-9">
                <div class="panel">
                    <header class="panel-heading">
                        <h3 class="panel-title">عرض البروفايل</h3>
                    </header>

                    <div class="panel-body">
                        <input type="hidden" name="old_email" value="<?= $data['email'] ?>">
                        <div class="col-md-6">
                            <div style="margin-bottom: 10px">
                                <h4 class="example-title">الاسم بالكامل</h4>
                                <input type="text" class="form-control round" id="fullname" name="fullname"
                                       value="<?= $data['fullname'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 10px">
                                <h4 class="example-title">اسم الحساب</h4>
                                <input type="text" class="form-control round" id="username" name="username"
                                       value="<?= $data['username'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 10px">
                                <h4 class="example-title">الايميل</h4>
                                <input type="text" class="form-control round" id="email" name="email"
                                       value="<?= $data['email'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 10px">
                                <h4 class="example-title">رقم الجوال</h4>
                                <input type="text" class="form-control round" id="mobile" name="mobile"
                                       value="<?= $data['mobile'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">صورة </h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <div class="example-wrap">
                            <!--<h4 class="example-title"></h4>-->
                            <div class="example">
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?? '' ?>">
                                <input type="file" name="image[]" id="input-file-now" class="dropify"
                                       value="<?= $data["image"] ?? '' ?>"
                                       data-plugin="dropify"
                                       data-default-file="<?php if (isset($data["image"])) echo 'files/media/' . $data["image"]; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">تعديل</h3>
                    </div>

                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <div class="mb-20">
                            <input name="id" id="id" type="hidden" value="<?= $data['id'] ?>">
                            <input type="hidden" name="action" id="action" value="update">
                            <button type="submit" name="submit_users"
                                    class="btn btn-block btn-primary waves-effect waves-classic">تعديل

                            </button>
                            <input type="hidden" name="profile" value="profile">
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>
        </div>
        <!-- End Panel Table Tools -->
    </div>
    <!-- End Page -->
</form>
