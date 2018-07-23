<?php
require_once "db.class.php";

class DEMO extends db
{

    private $table = "DEMO";

    public function __construct()
    {
    }

    public function ActivatedRecords()
    {
        if (isset($_POST["activate_test"])) {
            if (!isset($_POST["cat_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["cat_box"] as $val) {
                    $parameter = ['active' => 1];
                    parent::update($this->table, $parameter, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";

                echo "<div class='alert alert-success'>
			 		 								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
			 		 								 تم تفعيل العناصر المحدد بنجاح
			 		 							</div>";
            }
        }
    }

    public function DeactivatedRecords()
    {
        if (isset($_POST["deactivate_test"])) {
            if (!isset($_POST["cat_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["cat_box"] as $val) {
                    $parameter = ['active' => 0];
                    parent::update($this->table, $parameter, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";
                echo "<div class='alert alert-success'>
									 <button data-dismiss='alert' class='close m' type='button'>&times;</button>
										 تم إلغاء تفعيل العناصر المحدد بنجاح
								 </div>";
            }
        }
    }

    public function DeleteRecords()
    {
        if (isset($_POST["delete_test"])) {
            if (!isset($_POST["cat_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								     الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["cat_box"] as $val) {
                    parent::delete($this->table, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";
                echo "<div class='alert alert-success'>
		 								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
		 								 تم حذف العناصر المحدد بنجاح
		 							</div>";
            }
        }
    }

    public function EditRecord()
    {
        $validator = new GUMP('ar');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $parameter = [
                'name' => $_POST['name'],
                'date' => date("y-m-d"),
                'user' => $_SESSION['User_ID'],
            ];
            $rules = array(
                'name' => 'required',
                'user' => 'required',
            );
            $validated = $validator->validate($parameter, $rules);
            if ($validated !== TRUE) {
                $error = $validator->get_readable_errors(true);
                echo "<div class='alert alert-danger'>
						 <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								$error
					  </div>";
                return 0;
            }
            if (isset($_POST["active"])) {
                $parameter["active"] = $_POST["active"];
                $active = 1;
            } else {
                $parameter["active"] = 0;
                $active = 0;
            }

            if ($_POST['action'] == "insert") {


                $msg = parent::insert($this->table, $parameter);
                if ($msg) {
                    echo "<div class='alert alert-success'>
						<button data-dismiss='alert' class='close m' type='button'>&times;</button>
						تم الاضافة بنجاح 
					</div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_test\">";
                }
            }
            if ($_POST['action'] == "update") {
                $msg = parent::update($this->table, $parameter, $_GET['id']);
                if ($msg) {
                    echo "<div class='alert alert-success'>
                            <button data-dismiss='alert' class='close m' type='button'>&times;</button>
                            تم التعديل بنجاح 
                        </div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_test\">";
                }
            }

        }

    }
}