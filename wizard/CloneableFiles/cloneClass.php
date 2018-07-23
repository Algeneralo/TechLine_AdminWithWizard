<?php
/**
 * Created by PhpStorm.
 * User: Algeneral
 * Date: 7/17/2018
 * Time: 12:05 PM
 */
require_once "db.class.php";

class cloneClass extends db
{
    private $table = 'cloneClass';

    public function __construct()
    {
    }

    public function EditRecord()
    {
        $validator = new GUMP($_SESSION['lang'] ?? 'ar');
        if (isset($_POST["submit_cloneClass"])) {

            $parameter = [
                'name' => $_POST['name'],
                'date' => date('Y-m-d H:i:s'),
                'user_id' => $_SESSION['User_ID'],
                'active' => $_POST["active"] ?? 0,
            ];
            $rules = array(
                'name' => 'required',
//                'image'=>'required|extension,png;jpg;jpeg',
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

            if ($_POST['action'] == "insert") {
                //            $parameter['image'] = uploadImages()[0];
                $msg = parent::insert($this->table, $parameter);
                if ($msg) {
                    echo "<div class='alert alert-success'>
						<button data-dismiss='alert' class='close m' type='button'>&times;</button>
						تم الاضافة بنجاح 
					</div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_cloneClass\">";
                }
            }
            if ($_POST['action'] == "update") {
//                                        if ($_POST['old_image'] != $_FILES['image']['name'])
//                            $parameter['image'] = uploadImages()[0];
                $msg = parent::update($this->table, $parameter, $_GET['id']);
                if ($msg) {
                    echo "<div class='alert alert-success'>
                            <button data-dismiss='alert' class='close m' type='button'>&times;</button>
                            تم التعديل بنجاح 
                        </div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_cloneClass\">";
                }
            }

        }

    }


    public function GetRecords($id = null)
    {
        $id = $id != null ? 'id=' . $id : null;
        return parent::FetchData($this->table, $id);
    }

    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }


    public function ActivatedRecords()
    {
        if (isset($_POST["activate_cloneClass"])) {
            if (!isset($_POST["cloneClass_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["cloneClass_box"] as $val) {
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
        if (isset($_POST["deactivate_cloneClass"])) {
            if (!isset($_POST["cloneClass_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["cloneClass_box"] as $val) {
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
        if (isset($_POST["delete_cloneClass"])) {
            if (!isset($_POST["cloneClass_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								     الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["cloneClass_box"] as $val) {
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
}