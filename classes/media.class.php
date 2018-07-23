<?php

require_once('db.class.php');

class media extends db
{

    public $table = 'media';


    public function __construct()
    {

    }

    public function EditRecord()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $parameter["description"] = $_POST["description"];
            $parameter["lang_id"] = $_POST["lang"];
            $parameter["date"] = date("y-m-d");
            $parameter["type"] = 0;

            if (isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])) {

                /*$path = "../files/media/compress/";
                if (!empty($_POST['old_image'])) {
                    unlink('../files/media/' . $_GET['img']);
                    unlink('../files/media/compress/' . $_GET['img']);
                }*/

                $file = explode(".", $_FILES['image']['name']);
                $file_name = end($file);
                $allowed_ext = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG", "PNG", "GIF");
                if (in_array($file_name, $allowed_ext)) {
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


            if (isset($_POST["active"])) {
                $parameter["active"] = $_POST["active"];
                $a = 1;
            } else {
                $parameter["active"] = 0;
                $a = 0;
            }

            if ($_POST['action'] == "insert") {

                $msg = parent::insert($this->table, $parameter);
                if ($msg) {
                    echo "<div class='alert alert-success'>
						<button data-dismiss='alert' class='close m' type='button'>&times;</button>
						تم الاضافة بنجاح 
					</div>";
                }

            }
            if ($_POST['action'] == "update") {

                $msg = parent::update($this->table, $parameter, $_GET['id']);
                if ($msg) {
                    echo "<div class='alert alert-success'>
							<button data-dismiss='alert' class='close m' type='button'>&times;</button>
							تم التعديل بنجاح 
						</div>";

                }
            }
        }

    }


    public function DeleteRecords()
    {
        if (isset($_POST["delete_news"])) {
            if (!isset($_POST["news_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["news_box"] as $val) {
                    $prameter['active'] = -1;
                    parent::Update($this->table, $prameter, $val);
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
        if (isset($_POST["activate_news"])) {
            if (!isset($_POST["news_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["news_box"] as $val) {
                    $prameter['active'] = 1;
                    parent::Update($this->table, $prameter, $val);
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
        if (isset($_POST["deactivate_news"])) {
            if (!isset($_POST["news_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["news_box"] as $val) {
                    $prameter['active'] = 0;
                    parent::Update($this->table, $prameter, $val);
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