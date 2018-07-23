<?php
$configObject = new config();
$LangsObject = new langs();

if (isset($_GET["id"]) and $_GET["id"] != "") {
    $data = $configObject->GetAllRecords($_GET['id']);
    $dataconfig = $data["0"];
}

if (isset($_GET["action"]) and $_GET['action'] == "insert") {
    $l = 'إضافة الإعدادات';
    $s = 'نشر';
} else if (isset($_GET["action"]) and $_GET['action'] == "Update") {
    $l = 'تعديل الإعدادات';
    $s = 'تعديل';
}
?>
<div class="page-header">
    <h1 class="page-title">الإعدادات</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">الإعدادات</a></li>
        <li class="breadcrumb-item active"><?= $l ?></li>
    </ol>
</div>

<div class="page-content">
    <form action="" method="POST" enctype="multipart/form-data">
        <?php $configObject->EditRecord(); ?>
        <div class="row">
            <div class="col-md-9">
                <!-- Panel Form Elements -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $l ?></h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-md-12">
                                <div class="example-wrap">
                                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                                        <ul class="nav nav-tabs nav-tabs-reverse" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link active"
                                                                                        data-toggle="tab"
                                                                                        href="#exampleTabsReverseOne"
                                                                                        aria-controls="exampleTabsReverseOne"
                                                                                        role="tab"
                                                                                        aria-selected="false">الإعدادات
                                                    العامة</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                                                        data-toggle="tab"
                                                                                        href="#exampleTabsReverseTwo"
                                                                                        aria-controls="exampleTabsReverseTwo"
                                                                                        role="tab" aria-selected="true">بيانات
                                                    الإتصال</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                                                        data-toggle="tab"
                                                                                        href="#exampleTabsReverseThree"
                                                                                        aria-controls="exampleTabsReverseThree"
                                                                                        role="tab"
                                                                                        aria-selected="false">بيانات
                                                    التواصل الإجتماعي</a></li>
                                            <!--<li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsReverseF" aria-controls="exampleTabsReverseF" role="tab" aria-selected="false">من نحن</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#stats" aria-controls="exampleTabsReverseF" role="tab" aria-selected="false">الاحصائيات</a></li>-->
                                        </ul>
                                        <div class="tab-content pt-20">
                                            <div class="tab-pane active" id="exampleTabsReverseOne" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">اسم الموقع</h4>
                                                            <input type="text" class="form-control round" id="site_name"
                                                                   name="site_name"
                                                                   value="<?php if (isset($dataconfig["site_name"])) echo $dataconfig["site_name"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">مالك الموقع</h4>
                                                            <input type="text" class="form-control round"
                                                                   id="site_owner" name="site_owner"
                                                                   value="<?php if (isset($dataconfig["site_owner"])) echo $dataconfig["site_owner"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">وصف الموقع</h4>
                                                            <textarea rows="5" class="form-control"
                                                                      name="description"><?php if (isset($dataconfig["description"])) echo $dataconfig["description"]; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رابط الموقع</h4>
                                                            <input type="text" class="form-control round"
                                                                   id="site_url" name="site_url"
                                                                   value="<?php if (isset($dataconfig["site_url"])) echo $dataconfig["site_url"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="tab-pane" id="exampleTabsReverseTwo" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">ايميل الموقع</h4>
                                                            <input type="text" class="form-control round"
                                                                   id="site_email" name="site_email"
                                                                   value="<?php if (isset($dataconfig["site_email"])) echo $dataconfig["site_email"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رقم الفاكس</h4>
                                                            <input type="text" class="form-control round" id="fax"
                                                                   name="fax"
                                                                   value="<?php if (isset($dataconfig["fax"])) echo $dataconfig["fax"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رقم الجوال</h4>
                                                            <input type="text" class="form-control round" id="mobile"
                                                                   name="mobile"
                                                                   value="<?php if (isset($dataconfig["mobile"])) echo $dataconfig["mobile"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رقم الهاتف</h4>
                                                            <input type="text" class="form-control round" id="phone"
                                                                   name="phone"
                                                                   value="<?php if (isset($dataconfig["phone"])) echo $dataconfig["phone"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h4 class="example-title">عنوان الموقع</h4>
                                                            <textarea rows="5" class="form-control"
                                                                      name="address"><?php if (isset($dataconfig["address"])) echo $dataconfig["address"]; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="exampleTabsReverseThree" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رابط الفيس بوك</h4>
                                                            <input type="url" class="form-control round" id="fb"
                                                                   name="fb"
                                                                   value="<?php if (isset($dataconfig["fb"])) echo $dataconfig["fb"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رابط التويتر </h4>
                                                            <input type="url" class="form-control round" id="tw"
                                                                   name="tw"
                                                                   value="<?php if (isset($dataconfig["tw"])) echo $dataconfig["tw"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title"> رابط اليوتيوب</h4>
                                                            <input type="url" class="form-control round" id="yt"
                                                                   name="yt"
                                                                   value="<?php if (isset($dataconfig["yt"])) echo $dataconfig["yt"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رابط الإنستجرام</h4>
                                                            <input type="url" class="form-control round" id="ig"
                                                                   name="ig"
                                                                   value="<?php if (isset($dataconfig["ig"])) echo $dataconfig["ig"]; ?>">
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-6">
                                                          <div class="form-group">
                                                              <h4 class="example-title">رابط سكايب</h4>
                                                              <input type="url" class="form-control round" id="sk" name="sk" value="<?php /*if(isset($dataconfig["sk"])) echo $dataconfig["sk"]; */ ?>">
                                                          </div>
                                                      </div>-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">رابط قوقل بلس</h4>
                                                            <input type="url" class="form-control round" id="gp"
                                                                   name="gp"
                                                                   value="<?php if (isset($dataconfig["gp"])) echo $dataconfig["gp"]; ?>">
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-6">
                                                          <div class="form-group">
                                                              <h4 class="example-title">رابط pinter </h4>
                                                              <input type="url" class="form-control round" id="pin" name="pin" value="<?php /*if(isset($dataconfig["pin"])) echo $dataconfig["pin"]; */ ?>">
                                                          </div>
                                                      </div>-->
                                                    <!--<div class="col-md-6">
                                                          <div class="form-group">
                                                              <h4 class="example-title">رابط vimeo </h4>
                                                              <input type="url" class="form-control round" id="vimeo" name="vimeo" value="<?php /*if(isset($dataconfig["vimeo"])) echo $dataconfig["vimeo"]; */ ?>">
                                                          </div>
                                                      </div>-->
                                                </div>
                                            </div>
                                            <!-- ************************* -->
                                            <div class="tab-pane" id="exampleTabsReverseF" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">الأهداف</h4>
                                                            <textarea name="gools" class="form-control" rows="5">
                                                                <?php if (isset($dataconfig["gools"])) echo $dataconfig["gools"]; ?>
                                                            </textarea>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="example-wrap">
                                                            <!--<h4 class="example-title"></h4>-->
                                                            <div class="example">
                                                                <input type="file" name="imageG1" id="input-file-now"
                                                                       class="dropify" data-plugin="dropify"
                                                                       data-default-file=""/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">الرؤية</h4>
                                                            <textarea name="vision" class="form-control"
                                                                      rows="5"><?php if (isset($dataconfig["vision"])) echo $dataconfig["vision"]; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="example-wrap">
                                                            <!--<h4 class="example-title"></h4>-->
                                                            <div class="example">
                                                                <input type="file" name="imageV1" id="input-file-now"
                                                                       class="dropify" data-plugin="dropify"
                                                                       data-default-file=""/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">الرسالة</h4>
                                                            <textarea name="message" class="form-control"
                                                                      rows="5"><?php if (isset($dataconfig["message"])) echo $dataconfig["message"]; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="example-wrap">
                                                            <!--<h4 class="example-title"></h4>-->
                                                            <div class="example">
                                                                <input type="file" name="imageM" id="input-file-now"
                                                                       class="dropify" value="" data-plugin="dropify"
                                                                       data-default-file=""/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h4 class="example-title">نص المشاريع</h4>
                                                            <input class="form-control round" type="text"
                                                                   name="text_proj" placeholder="نص المشاريع"
                                                                   value="<?php if (isset($dataconfig["text_proj"])) echo $dataconfig["text_proj"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h4 class="example-title">نص الشركاء</h4>
                                                            <input class="form-control round" type="text"
                                                                   name="text_partners" placeholder="نص الشركاء"
                                                                   value="<?php if (isset($dataconfig["text_partners"])) echo $dataconfig["text_partners"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h4 class="example-title">نص الأخبار</h4>
                                                            <input class="form-control round" type="text"
                                                                   name="text_news" placeholder="نص الأخبار"
                                                                   value="<?php if (isset($dataconfig["text_news"])) echo $dataconfig["text_news"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h4 class="example-title">نص معرض الصور والفيديو</h4>
                                                            <input class="form-control round" type="text"
                                                                   name="text_media"
                                                                   placeholder="نص معرض الصور والفيديو"
                                                                   value="<?php if (isset($dataconfig["text_media"])) echo $dataconfig["text_media"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h4 class="example-title">نص تواصل معنا</h4>
                                                            <input class="form-control round" type="text"
                                                                   name="text_contact" placeholder="نص تواصل معنا"
                                                                   value="<?php if (isset($dataconfig["text_contact"])) echo $dataconfig["text_contact"]; ?>">
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h4 class="example-title">نص زر اقرأ المزيد</h4>
                                                            <input class="form-control round" type="text" name="botton"
                                                                   placeholder="نص زر اقرأ المزيد"
                                                                   value="<?php if (isset($dataconfig["botton"])) echo $dataconfig["botton"]; ?>">
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Panel Form Elements -->

            </div>
            <div class="col-md-3">
                <!-- Panel Input Groups -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">اللغة</h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <!-- Example Basic -->
                        <div class="example-wrap">
                            <div class="example z-marg">
                                <select class="form-control" name="lang" data-plugin="select2" disabled>
                                    <?php foreach ($LangsObject->GetAllRecords() as $lang) { ?>
                                        <option <?php if (isset($dataconfig['lang']) and $dataconfig['lang'] == $lang['id']) echo 'selected'; ?> <?php if (isset($dataconfig['lang']) and $dataconfig['lang'] == $lang['id']) echo 'selected'; ?>
                                                value="<?= $lang['id'] ?>"><?= $lang['name'] ?></option>
                                    <?php } ?>
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
                        <h3 class="panel-title">نشر</h3>
                    </div>

                    <div class="panel-body container-fluid">
                        <!-- Example Default -->
                        <div class="mb-20">
                            <input name="id" id="id" type="hidden"
                                   value="<?php if (isset($dataconfig["id"])) echo $dataconfig["id"]; ?>"/>
                            <input type="hidden" name="action" id="action" value="<?php echo $_GET["action"]; ?>"/>
                            <button type="submit" id="submit_config" name="submit_config"
                                    class="btn btn-block btn-primary"><?= $s ?> </button>
                            <a href="index.php?page=view_config" class="btn btn-block btn-danger">رجوع</a>
                        </div>
                    </div>
                    <!-- End Panel Input Groups -->
                </div>
            </div>


        </div>
    </form>
</div>

<!-- End Page -->


