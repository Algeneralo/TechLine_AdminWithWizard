<?php

require_once "db.class.php";

class category extends db
{
    private $table = 'category';

    public function __construct()
    {
    }

    public function EditRecord()
    {
        $validator = new GUMP('ar');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $parameter = [
                'name' => $_POST['name'],
                'date' => date('Y-m-d H:i:s'),
                'user_id' => $_SESSION['User_ID'],
                'parent_id' => $_POST['parent_id'],
                'active' => $_POST['active'] ?? 0,
            ];
            $rules = array(
                'name' => 'required',
                'parent_id' => 'required',
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
                $parameter['type'] = 0;
                $msg = parent::insert($this->table, $parameter);
                if ($msg) {
                    echo "<div class='alert alert-success'>
						<button data-dismiss='alert' class='close m' type='button'>&times;</button>
						تم الاضافة بنجاح 
					</div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_cat\">";
                }
            }
            if ($_POST['action'] == "update") {
                $msg = parent::update($this->table, $parameter, $_GET['id']);
                if ($msg) {
                    echo "<div class='alert alert-success'>
                            <button data-dismiss='alert' class='close m' type='button'>&times;</button>
                            تم التعديل بنجاح 
                        </div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_cat\">";
                }
            }

        }

    }

    public function GetCount($id)
    {
        $sql = sprintf("select parent_id from %s where parent_id =:id", $this->table);
        $data = db::FetchQuery($sql, $id);
        return count($data);
    }

    public function GetMenuRecords($id = null)
    {
        $where = $id != null ? " and id=:id " : null;
        $sql = sprintf("select c.* , u.fullname as user_name  
                               from %s c
                               join %s u on u.id = c.user_id
                               where c.active =1 %s  
                               ORDER by c.id desc", $this->table, 'users', $where);
        return db::FetchQuery($sql, $id);
    }


    function SelectCat()
    {
        $sql = sprintf("select %s.*, %s.username
                               from %s
                               inner join users on users.id = category.user_id
                               where category.active != -1 
                               order by category.id desc", $this->table, 'users', $this->table);
        return db::FetchQuery($sql);
    }


    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }


    public function viewCat($where = NULL)
    {
        $where = $where != null ? 'and ' . $where : '';
        $sql = sprintf("select %s.*, %s.username as user_user
                               from %s
                               inner join users on users.id = category.user_id
                               where category.active != -1 %s
                               order by category.id desc", $this->table, 'users', $this->table, $where);
        return db::FetchQuery($sql);

    }

    public function ActivatedRecords()
    {
        if (isset($_POST["activate_cat"])) {
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
        if (isset($_POST["deactivate_cat"])) {
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
        if (isset($_POST["delete_cat"])) {
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


}