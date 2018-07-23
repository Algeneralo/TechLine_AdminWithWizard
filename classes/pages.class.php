<?php

require_once "db.class.php";

class pages extends db
{

    public $table = 'pages';

    public function __construct()
    {

    }

    function EditRecord()
    {
        $validator = new GUMP('ar');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $parameter['name'] = $_POST['name'];
            $parameter['body'] = $_POST['body'];
            $parameter['date'] = date('Y-m-d H:i:s');
            $parameter["active"] = $_POST["active"] ?? 0;
            $rules = array(
                'name' => 'required',
                'body' => 'required',
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
            if (isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])) {

                /*$path = "../files/media/compress/";
                if (!empty($_POST['old_image'])) {
                    unlink('../files/media/' . $_GET['img']);
                    unlink('../files/media/compress/' . $_GET['img']);
                }*/

                $file = explode(".", $_FILES['image']['name']);
                $file_name = end($file);
                $activellowed_ext = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG", "PNG", "GIF");
                if (in_array($file_name, $activellowed_ext)) {
                    $new_name = time() . '.' . $file_name;
                    $sourcePath = $_FILES['image']['tmp_name'];
                    $targetPath = "../images/" . $new_name;

                    if (move_uploaded_file($sourcePath, $targetPath)) {

                        //$new = compress_image($targetPath, $path . $new_name, 50);
                        //Thumbme($new_name , "../../files/media/","../../files/media/small/",350,400);
                        $parameter['image'] = $new_name;
                    }
                } else {
                    echo "<div class='alert alert-danger'>
                                  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
                                   الرجاء اختيار صورة 
                                </div>";
                    exit();
                }
            }


            //print_r($parameter);

            if ($_POST['action'] == "insert") {

                $parameter['type'] = 0;
                $parameter['link'] = '';
                $parameter['lang_id'] = 1;
                $parameter['user_id'] = $_SESSION['User_ID'];
                $msg = parent::Insert($this->table, $parameter);
                if ($msg) {
                    echo "<div class='alert alert-success'>
						<button data-dismiss='alert' class='close m' type='button'>&times;</button>
						تم الاضافة بنجاح 
					</div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_pages\">";

                }

            }
            if ($_POST['action'] == "update") {

                $msg = parent::update($this->table, $parameter, $_GET['id']);
                if ($msg) {
                    echo "<div class='alert alert-success'>
							<button data-dismiss='alert' class='close m' type='button'>&times;</button>
							تم التعديل بنجاح 
						</div>";
                    echo "<meta http-equiv=\"refresh\" content=\"1;URL=?page=view_pages\">";
                }

            }

        }

    }

    public function GetAllRecordsForMenu($id = null)
    {
        $where = $id != null ? " and id=:id " : null;
        $sql = sprintf("select p.* , l.name as lang_name , u.fullname as user_name from pages p 
                              join langs l on l.id = p.lang_id
                              join users u on u.id = p.user_id
                              where p.active = 1 %s  ORDER by p.id desc", $where);
        return db::FetchQuery($sql, $id);
    }


    function SelectCat()
    {
        return parent::FetchData('category');
    }

    function SelectPages()
    {
        return parent::FetchData('page');
    }


    public function viewPages($where = NULL)
    {
        $where = $where != null ? $where : '';
        $sql = "select pages.*, users.username as user_name from pages
                INNER JOIN users on users.id = pages.user_id
                 where pages.active != -1 
                 $where order by pages.id desc";
        return parent::FetchQuery($sql);

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
        if (isset($_POST["deactivate_cat"])) {
            if (!isset($_POST["cat_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["cat_box"] as $val) {
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