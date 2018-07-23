<?php
$contactObject = new contact();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $data = $contactObject->GetAllRecords($_GET['id']);
    $datacontact = $data["0"];
} else {
    header('location:index.php');
}

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة تصنيف';
    $s = 'نشر';
} else if (isset($_GET["action"]) and $_GET['action'] == "Update") {
    $l = 'الرد على الرسائل';
    $s = 'رد';
}
?>
<div class="page-header">
    <h1 class="page-title">الرسائل</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">الرسائل</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form action="" method="POST" enctype="multipart/form-data">
        <input name="name" type="hidden" value="<?php if (isset($datacontact["name"])) echo $datacontact["name"]; ?>">
        <input name="email" type="hidden"
               value="<?php if (isset($datacontact["email"])) echo $datacontact["email"]; ?>">
        <?php $contactObject->EditRecord(); ?>
        <div class="row">
            <div class="col-md-9">
                <!-- Panel Form Elements -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">معلومات الرسالة</h3>
                    </div>
                    <div class="panel-body container-fluid">

                        <table class="table table-bordered" id="DivIdToPrint">
                            <tbody>
                            <tr>
                                <td width="30%">الإسم</td>
                                <td><?= $datacontact['name'] ?></td>
                            </tr>
                            <tr>
                                <td width="30%">البريد الإلكتروني</td>
                                <td><?= $datacontact['email'] ?></td>
                            </tr>
                            <tr>
                                <td width="30%">نص الرسالة</td>
                                <td><?= $datacontact['message'] ?></td>
                            </tr>
                            <?php if ($datacontact['active'] == 1) { ?>
                                <tr>
                                    <td width="30%">نص الرد على الرسالة</td>
                                    <td><?= $datacontact['reply'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- End Panel Form Elements -->
                <?php if ($datacontact['active'] == 0) { ?>
                    <!-- Panel Input Groups -->
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <h3 class="panel-title"> الرد على الرسالة</h3>
                                </div>
                            </div>

                        </div>
                        <div class="panel-body container-fluid">
                            <!-- Example Default -->
                            <div class="example">
                                <textarea id="cke" class="cke"
                                          name="reply"><?php if (isset($datacontact["reply"])) echo $datacontact["reply"]; ?></textarea>
                            </div>
                        </div>
                        <!-- End Panel Input Groups -->
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3">


                <!-- Panel Input Groups -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">الخيارات</h3>
                    </div>

                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <div class="mb-20">
                            <input name="id" id="id" type="hidden"
                                   value="<?php if (isset($datacontact["id"])) echo $datacontact["id"]; ?>"/>
                            <input type="hidden" name="action" id="action" value="<?php echo $_GET["action"]; ?>"/>
                            <button type="submit" id="submit_contact" name="submit_contact"
                                    class="btn btn-block btn-primary"><?= $s ?> </button>
                            <a href="index.php?page=view_contact" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>


        </div>
    </form>
</div>

<!-- End Page -->


