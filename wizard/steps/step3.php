<!-- Page -->
<div class="page">
    <form method="post" action="" id="form">
        <input type="hidden" name="createClasses" value="createClasses">
        <?php (new Controller())->createClasses() ?>
        <div class="page-header">
            <h1 class="page-title">انشاء classes</h1>
        </div>
        <div class="page-content">
            <!-- Panel Table Tools -->
            <div class="panel col-md-9">
                <header class="panel-heading">
                    <h3 class="panel-title">القائمة العلوية</h3>
                </header>

                <div class="panel-body">
                    <div id="cloneable" class="col-md-8" style="margin-bottom: 10px">
                        <label style="float: right">اسم class:</label>
                        <div class="col-md-4">
                            <input name="className[]" class="form-control" type="text">
                        </div>
                        <div class="col-md-4">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" disabled checked>
                                <input type="hidden" name="class[]" value="1">
                                <label>class</label>
                            </div>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox">
                                <input type="hidden" name="manage[]" value="0">
                                <label>manage</label>
                            </div>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox">
                                <input type="hidden" name="view[]" value="0">
                                <label>view</label>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="co-md-1">
                            <button type="button" class="addBtn btn-success">
                                <i class="icon fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3" style="float: left !important;">
                        <button type="submit"
                                class="btn btn-block btn-primary waves-effect waves-classic">انهاء
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Panel Table Tools -->

        </div>
        <!-- End Page -->
    </form>
</div>
