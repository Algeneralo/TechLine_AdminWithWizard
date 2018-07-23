<?php
$data = new users();
$countUser = $data->SelectCount("users");
$countCat = $data->SelectCount("category");
$countPages = $data->SelectCount("pages");
$countPost = $data->SelectCount("post");

?>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-3">
            <!-- Card -->
            <div class="card card-block p-30 bg-green-600">
                <div class="card-watermark darker font-size-80 m-15"><i class="icon md-accounts" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter-inverse text-left">
                    <div class="counter-number-group">
                        <span class="counter-number">عدد الأعضاء</span>
                        <span class="counter-number-related text-capitalize"><?= $countUser ?></span>
                    </div>
                    <div class="counter-label text-capitalize"></div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-md-3">
            <!-- Card -->
            <div class="card card-block p-30 bg-blue-600">
                <div class="card-watermark darker font-size-80 m-15"><i class="icon md-collection-music"
                                                                        aria-hidden="true"></i></div>
                <div class="counter counter-md counter-inverse text-left">
                    <div class="counter-number-group">
                        <span class="counter-number">عدد التصنيفات</span>
                        <span class="counter-number-related text-capitalize"><?= $countCat ?></span>
                    </div>
                    <div class="counter-label text-capitalize"></div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-md-3">
            <!-- Card -->
            <div class="card card-block p-30 bg-purple-600">
                <div class="card-watermark darker font-size-80 m-15"><i class="icon md-image" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter-inverse text-left">
                    <div class="counter-number-group">
                        <span class="counter-number">عدد الصفحات</span>
                        <span class="counter-number-related text-capitalize"><?= $countPages ?></span>
                    </div>
                    <div class="counter-label text-capitalize"></div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-md-3">
            <!-- Card -->
            <div class="card card-block p-30 bg-red-600">
                <div class="card-watermark darker font-size-80 m-15"><i class="icon md-assignment"
                                                                        aria-hidden="true"></i></div>
                <div class="counter counter-md counter-inverse text-left">
                    <div class="counter-number-group">
                        <span class="counter-number">عدد المواضيع</span>
                        <span class="counter-number-related text-capitalize"><?= $countPost ?></span>
                    </div>
                    <div class="counter-label text-capitalize"></div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel" id="projects">
                <div class="panel-heading">
                    <h3 class="panel-title">آخر الأعضاء المسجلين</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>اسم المستخدم</td>
                            <td>الايميل</td>
                            <td>تاريخ التسجيل</td>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $selectusers = $data->SelectAll("users");
                        foreach ($selectusers as $value) {


                            ?>
                            <tr>
                                <td><?= $value['username'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['date'] ?></td>


                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel" id="projects">
                <div class="panel-heading">
                    <h3 class="panel-title">آخر الصفحات المضافة</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>الاسم</td>

                            <td>تاريخ الاضافة</td>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $selectusers = $data->SelectAll("pages");
                        foreach ($selectusers as $value) {


                            ?>
                            <tr>
                                <td><?= $value['name'] ?></td>

                                <td><?= $value['date'] ?></td>


                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>