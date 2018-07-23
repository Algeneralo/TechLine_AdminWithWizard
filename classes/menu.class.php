<?php
require_once('db.class.php');

class menu extends db
{

    public $table = 'menu';

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
        $where = $id != null ? " and m.id=:id " : null;
        $sql = sprintf("select m.*  , u.fullname as user_name from menu m 
                               join users u on u.id = m.user_id
                               where m.active != -1 %s ORDER by m.id desc", $where);
        return parent::FetchQuery($sql, $id);

    }

    public function GetAllRecordsItem($id)
    {
        $sql = "select * from menu_item where menu_id = :id";
        return parent::FetchQuery($sql, $id);
    }

    public function GetType($id, $menu_id, $type)
    {

        $arr = array();
        $sql = parent::getConnection()->prepare('select * from menu_item where menu_id = :menu_id and page_id = :id and type = :type limit 1');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->bindValue(':menu_id', $menu_id, PDO::PARAM_INT);
        $sql->bindValue(':type', $type, PDO::PARAM_INT);
        $sql->execute();

        while ($row = $sql->fetch(PDO::FETCH_BOTH)) {
            $arr[] = $row;
        }
        return $arr;


    }

    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }


    public function EditRecord()
    {
        $validator = new GUMP('ar');
        if (isset($_POST["submit_menu"])) {

            $parameter["name"] = $_POST["name"];
            $parameter["place_id"] = $_POST["place_id"];

            if (isset($_POST["active"])) {
                $parameter["active"] = $_POST["active"];
                $a = 1;
            } else {
                $parameter["active"] = 0;
                $a = 0;
            }

            $rules = array(
                'name' => 'required',
                'place_id' => 'required',
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
            if ($_POST["action"] == "Update") {

                try {
                    $msg = parent::update($this->table, $parameter, $_GET['id']);

                    if ($msg != 0 or !empty($msg)) {

                        parent::delete('menu_item', $_GET['id']);

                        if (!empty($_POST['category'])) {
                            foreach ($_POST['category'] as $key => $value) {
                                $Category['page_id'] = $_POST['category'][$key];
                                $Category['ordered'] = $_POST['order_category'][$key];
                                $Category['type'] = 1;
                                $Category['menu_id'] = $msg;
                                parent::insert('menu_item', $Category);
                            }
                        }

                        if (!empty($_POST['page'])) {
                            foreach ($_POST['page'] as $key => $value) {
                                $Pages['page_id'] = $_POST['page'][$key];
                                $Pages['ordered'] = $_POST['order_page'][$key];
                                $Pages['type'] = 2;
                                $Pages['menu_id'] = $msg;
                                parent::Insert('menu_item', $Pages);
                            }
                        }

                        echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   تمت عملية التعديل بنجاح
								</div>";
                        echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=?page=view_menu\">";
                    } else {
                        echo "<div class='alert alert-danger'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   يوجد خطأ داخلي
								</div>";
                    }
                } catch (Exception $e) {
                    //header('location:index.php?page=404');
                }

            }

            if ($_POST["action"] == "insert") {
                $parameter["user_id"] = $_SESSION['User_ID'];
                try {
                    $msg = parent::insert($this->table, $parameter);

                    if (!empty($_POST['category'])) {
                        foreach ($_POST['category'] as $key => $value) {
                            $Category['page_id'] = $_POST['category'][$key];
                            $Category['ordered'] = $_POST['order_category'][$key];
                            $Category['type'] = 1;
                            $Category['menu_id'] = $msg;
                            parent::insert('menu_item', $Category);
                        }
                    }

                    if (!empty($_POST['page'])) {
                        foreach ($_POST['page'] as $key => $value) {
                            $Pages['page_id'] = $_POST['page'][$key];
                            $Pages['ordered'] = $_POST['order_page'][$key];
                            $Pages['type'] = 2;
                            $Pages['menu_id'] = $msg;
                            parent::insert('menu_item', $Pages);
                        }
                    }

                    if ($msg != 0 or !empty($msg)) {

                        echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   تمت عملية الإضافة بنجاح
								</div>";
                        echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=?page=view_menu\">";
                    } else {
                        echo "<div class='alert alert-danger'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   يوجد خطأ داخلي
								</div>";
                    }
                } catch (Exception $e) {
                    //header('location:index.php?page=404');
                }
            }
        }

    }


    public function DeleteRecords()
    {
        if (isset($_POST["delete_menu"])) {
            if (!isset($_POST["menu_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["menu_box"] as $val) {
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
        if (isset($_POST["activate_menu"])) {
            if (!isset($_POST["menu_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["menu_box"] as $val) {
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
        if (isset($_POST["deactivate_menu"])) {
            if (!isset($_POST["menu_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["menu_box"] as $val) {
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