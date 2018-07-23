<?php
require_once('db.class.php');

class langs extends db
{

    public $table = 'langs';

    public function __construct()
    {

    }


    public function GetLastRecords()
    {
        $SQL = parent::LastRecord($this->table);

        if (count($SQL) > 0) {
            return $SQL;
        } else {
            return "0";
        }
    }

    public function GetAllRecords($id = null)
    {
        $where = $id != null ? "id=" . $id : null;
        return db::FetchData($this->table, $where);
    }

    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }

    public function EditRecord()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $parameter = [
                'name' => $_POST["name"],
                'date' => date("y-m-d")
            ];

            if (isset($_POST["active"])) {
                $parameter["active"] = $_POST["active"];
                $active = 1;
            } else {
                $parameter["active"] = 0;
                $active = 0;
            }

            if ($_POST["action"] == "Update") {

                try {
                    $msg = parent::update($this->table, $parameter, $_GET['id']);

                    if ($msg != 0 or !empty($msg)) {

                        echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   " . "تم التعديل بنجاح" . "
								</div>";

                    } else {
                        echo "<div class='alert alert-danger'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   " . _ERROR . "
								</div>";
                    }
                } catch (Exception $e) {
                    //header('location:index.php?page=404');
                }

            }

            if ($_POST["action"] == "insert") {

                try {
                    $msg = parent::insert($this->table, $parameter);
                    if ($msg != 0 or !empty($msg)) {

                        echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   " . "تم الاضافة بنجاح" . "
								</div>";

                    } else {
                        echo "<div class='alert alert-danger'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   " . _ERROR . "
								</div>";
                    }
                } catch (Exception $e) {
                    header('location:index.php?page=404');
                }
            }
        }

    }


    public function DeleteRecords()
    {
        if (isset($_POST["delete_langs"])) {
            if (!isset($_POST["langs_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["langs_box"] as $val) {
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


    public function ActivatedRecords()
    {
        if (isset($_POST["activate_langs"])) {
            if (!isset($_POST["langs_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["langs_box"] as $val) {
                    $parameter['active'] = 1;
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
        if (isset($_POST["deactivate_langs"])) {
            if (!isset($_POST["langs_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["langs_box"] as $val) {
                    $parameter['active'] = 0;
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


}

?>