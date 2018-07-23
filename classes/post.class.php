<?php

require_once "db.class.php";

class post extends db
{

    public $table = 'post';

    public function __construct()
    {

    }

    function sendEmails()
    {
        $sql = "select email from participation where active = 1";

        $rows = parent::FetchQuery($sql);

        $emails = "";
        foreach ($rows as $row) {
            $emails .= $row['email'] . ",";
        }
        return rtrim($emails, ',');
    }

    function EditRecord()
    {
        $validator = new GUMP('ar');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $parameter['title'] = $_POST['title'];
            $parameter['details'] = $_POST['details'];
            $parameter['date'] = date('Y-m-d H:i:s');
            $parameter['user_id'] = $_SESSION['User_ID'];
            $parameter["active"] = $_POST["active"] ?? 0;
            $parameter['category_id'] = $_POST['category_id'];

            $rules = array(
                'title' => 'required',
                'details' => 'required',
                'category_id' => 'required',
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
                //ar language
                $parameter['lang_id'] = 1;
                $parameter['counter'] = 0;
                $parameter['image'] = uploadImages()[0];
                $msg = parent::insert($this->table, $parameter);
                if ($msg) {
                    echo "<div class='alert alert-success'>
						<button data-dismiss='alert' class='close m' type='button'>&times;</button>
						تم الاضافة بنجاح 
					</div>";
                    echo '<meta http-equiv="refresh" content="0;url=?page=view_post">';
                }
            }
            if ($_POST['action'] == "update") {
                //check if there's new image or not
                if ($_POST['old_image'] != $_FILES['image']['name'][0] && !empty($_FILES['image']['name'][0]))
                    $parameter['image'] = uploadImages()[0];
                $msg = parent::update($this->table, $parameter, $_GET['id']);
                if ($msg) {
                    echo "<div class='alert alert-success'>
							<button data-dismiss='alert' class='close m' type='button'>&times;</button>
							تم التعديل بنجاح 
						</div>";
                    print '<meta http-equiv="refresh" content="0;url=?page=view_post">';

                }
            }
        }
    }


    public function GetAllRecords($id = null)
    {
        $where = $id != null ? " and post.id=:id " : null;
        $arr = array();
        $sql = sprintf('select post.*, users.username as user_name, category.name as cat_title
                                    from post INNER JOIN users on users.id = post.user_id
                                     INNER JOIN category on category.id = post.category_id
                                      where post.active != -1 and post.category_id != 30 and category.active = 1 %s
                                       order by post.id desc', $where);
        return db::FetchQuery($sql, $id);
    }


    public function viewPost($id)
    {
        $sql = "select post.*, users.username as user_name, category.name as cat_title
                from post INNER JOIN users on users.id = post.user_id
                INNER JOIN category on category.id = post.category_id
                where post.active != -1 and post.category_id =:id
                order by post.id desc";
        return parent::FetchQuery($sql, $id);

    }

    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }

    public function ActivatedRecords()
    {
        if (isset($_POST["activate_post"])) {
            if (!isset($_POST["post_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["post_box"] as $val) {
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
        if (isset($_POST["deactivate_post"])) {
            if (!isset($_POST["post_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["post_box"] as $val) {
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

    public function DeleteRecords()
    {
        if (isset($_POST["delete_post"])) {
            if (!isset($_POST["post_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["post_box"] as $val) {
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