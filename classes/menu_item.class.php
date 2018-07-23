<?php

require_once "db.class.php";

class menu_item extends db
{

    public $table = 'menu_item';


    public function __construct()
    {

    }

    public function GetMenuItem()
    {
        $sql = "select m.* , m1.name as menu_name  from menu_item m
                join menu m1 on m1.id = m.menu_id
                where m1.active = 1 order by m.order_m asc";
        return parent::FetchQuery($sql);
    }

    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }

    public function GetAttrAll($menu_id, $m_id, $type)
    {
        $sql = parent::getConnection()->prepare("select * from menu_item where menu_id = ? and m_id = ? and type = ?");
        $sql->execute(array($menu_id, $m_id, $type));
        return $sql->fetch();
    }


    function EditRecord()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $i = 0;
            if (isset($_POST['menu_item'])) {
                $parameter['menu_id'] = $_GET['id'];
                $sql = "delete from menu_item where menu_id =:id";
                parent::FetchQuery($sql, $_GET['id']);
                foreach ($_POST['menu_item'] as $value) {
                    $num = explode(" ", $value);
                    $parameter['m_id'] = $num[0];
                    $parameter['type'] = $num[1];
                    $parameter['order_m'] = $_POST['order_m' . $num[2]];
                    if (isset($_POST["active"])) {
                        $parameter["active"] = $_POST["active"];
                        $a = 1;
                    } else {
                        $parameter["active"] = 0;
                        $a = 0;
                    }
                    parent::insert($this->table, $parameter);
                }
            }

            if ($_POST['action'] == "update") {
                $parameter['last_update'] = date("y-m-d h:i:sa");
                $parameter['user_update'] = $_SESSION['User_ID'];
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

    public function selectItem()
    {
        $sql = "select * from menu_item where menu_id =:id and active != 0";
        print_r(parent::FetchQuery($sql, $_GET['id']));
    }

    public function ViewMenuItemCats($where = NULL)
    {
        $sql = "select menu_item.*, menu.name as menu_name, category.title from menu_item 
                INNER join menu on menu.id = menu_item.menu_id
                 inner join category on category.id = menu_item.m_id
                  where menu_item.type = 0 and menu_item.active != -1";
        return parent::FetchQuery($sql);

    }

    public function ViewMenuItemPages($where = NULL)
    {

        $sql = "select menu_item.*, menu.name as menu_name, pages.name from menu_item
                INNER join menu on menu.id = menu_item.menu_id
                 inner join pages on pages.id = menu_item.m_id
                  where menu_item.type = 1 and menu_item.active != -1";
        return parent::FetchQuery($sql);

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
        if (isset($_POST["deactivate_news"])) {
            if (!isset($_POST["news_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["news_box"] as $val) {
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
        if (isset($_POST["delete_news"])) {
            if (!isset($_POST["news_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								  الرجاء تحديد عنصر واحد على الأقل
							</div>";
            } else {
                foreach ($_POST["news_box"] as $val) {
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