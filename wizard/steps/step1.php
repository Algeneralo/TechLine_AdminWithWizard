<!-- Page -->
<div class="page">
    <form method="post" action="" id="form">
        <input type="hidden" name="saveUser">
        <?php (new Controller())->saveUserData(); ?>
        <div class="page-header">
            <h1 class="page-title">بيانات الدخول</h1>
        </div>

        <div class="page-content">
            <!-- Panel Table Tools -->
            <div class="panel col-md-9">
                <header class="panel-heading">
                    <h3 class="panel-title">بيانات الدخول</h3>
                </header>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 pull-left">
                            <h4 class="example-title">الاسم بالكامل </h4>
                            <input type="text" class="form-control round" id="fullName" name="fullName">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pull-left">
                            <h4 class="example-title">اسم المستخدم</h4>
                            <input type="text" class="form-control round" id="username" name="username">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 10px">
                            <h4 class="example-title">كلمة المرور</h4>
                            <input type="password" class="form-control round" id="password" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 10px">
                            <h4 class="example-title">تاكيد كلمة المرور</h4>
                            <input type="password" class="form-control round" id="passwordConfirm"
                                   name="passwordConfirm">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 10px">
                            <h4 class="example-title">الايميل</h4>
                            <input type="email" class="form-control round" id="email" name="email">
                        </div>
                    </div>
                    <div class="row col-md-2" style="float: left !important;">
                        <button type="submit" id="submit_news" name="submit_news"
                                class="btn btn-block btn-primary waves-effect waves-classic">التالي
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Panel Table Tools -->

        </div>
        <!-- End Page -->
    </form>
</div>
