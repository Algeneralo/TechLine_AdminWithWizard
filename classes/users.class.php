<?php session_start();
/**
 *
 */
require_once('db.class.php');

class users extends db
{

    public $table = 'users';


    public function __construct()
    {

    }

    public function Login()
    {
        if (isset($_SESSION['User_ID'])) {
            GoToURL("index.php");
            die();
        }

        if (isset($_POST['login_submit'])) {
            $sql = parent::getConnection()->prepare('select * from ' . $this->table . ' where email= ? and password= ? and active = 1');
            $sql->execute(array($_POST['email'], sha1($_POST['password'])));
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if ($sql->rowCount() != 0) {
                $_SESSION['User_ID'] = $row['id'];
                $_SESSION['Username'] = $row['username'];
                $_SESSION['image'] = $row['image'];
                GOToURL("index.php");
                exit;
            } else {
                echo '<div class="row justify-content-center"><div class="col-md-8"><div class="alert alert-danger" role="alert">خطأ في البريد الالكتروني أو كلمة المرور</div></div></div>';
                return false;
            }
        }

    }


    public function Logout()
    {
        if (!isset($_SESSION['User_ID'])) {
            GoToURL("login.php");
            die();
        }
        if (isset($_GET['logout'])) {
            if ($_GET['logout'] == 1) {
                session_destroy();
                GoToURL("login.php");
                exit;
            }
        }
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

    function SelectCount($table)
    {
        $sql = "select * from {$table} where active != -1";

        return count(parent::FetchQuery($sql));
    }

    public function SelectAll($table)
    {

        $sql = "select * from {$table} where active != -1 order by id desc limit 5";

        return parent::FetchQuery($sql);
    }

    public function GetAllRecords($id = null)
    {
        $where = $id != null ? " where id=:id " : null;

        $sql = sprintf('select u.*, p.name as u_permission  from users u
				left join user_permission p on p.id = u.permission
				%s order by u.id desc', $where);
        return db::FetchQuery($sql, $id);
    }

    public function getUsers($where = NULL)
    {
        $where = $where != null ? ' and ' . $where : '';
        $sql = "select * from {$this->table} where active != -1 {$where} order by id desc";
        return parent::FetchQuery($sql);
    }

    public function GetRecords($from, $to)
    {
        $SQL = parent::FetchWithLimit($this->table, $from, $to);
        if (count($SQL) > 0) {
            return $SQL;
        } else {
            return "0";
        }
    }

    public function EditRecord()
    {
        $validator = new GUMP('ar');
        if (isset($_POST["submit_users"])) {

            $parameter = [
                'username' => $_POST['username'],
                'fullname' => $_POST['fullname'],
                'email' => $_POST['email'],
                'mobile' => $_POST['mobile'],
                'date' => date('Y-m-d H:i:s'),
                'active' => $_POST["active"] ?? 0,
            ];
            $rules = array(
                'username' => 'required',
                'fullname' => 'required',
                'mobile' => 'required',
                'email' => 'required',
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
                if (!$this->check_email($_POST['email'])) {
                    $parameter['password'] = sha1($_POST['password']);
                    $parameter['image'] = uploadImages()[0];
                    $msg = parent::insert($this->table, $parameter);
                    if ($msg) {
                        echo " <div class='alert alert-success' >
								  <button data-dismiss = 'alert' class='close' type = 'button' >&times;</button >
                            " . "تم الاضافة بنجاح" . "
                          </div > ";
                        echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=?page=view_users\">";
                    } else
                        echo " <div class='alert alert-success' >
								  <button data-dismiss = 'alert' class='close' type = 'button' >&times;</button >
                            " . "حدث خلل,الرجاء المحاولة لاحقا" . "
                          </div > ";
                } else {
                    echo " <div class='alert alert-danger' >
								  <button data-dismiss = 'alert' class='close' type = 'button' >&times;</button >
                            " . "هذا الايميل مستخدم" . "
                          </div > ";
                }
            } else
                if ($_POST['action'] == "update") {
                    if ($_POST['email'] != $_POST['old_email'] and $this->check_email($_POST['email'])) {
                        echo " <div class='alert alert-danger' >
								  <button data-dismiss = 'alert' class='close' type = 'button' >&times;</button >
                            " . "هذا الايميل مستخدم" . "
                          </div > ";
                        return 0;
                    } else {
                        //check if there's new image or not
                        if ($_POST['old_image'] != $_FILES['image']['name'][0] && !empty($_FILES['image']['name'][0]))
                            $parameter['image'] = uploadImages()[0];
                        if (!empty($_POST['password'])) {
                            $parameter['password'] = sha1($_POST['password']);
                        }
                        $msg = parent::update($this->table, $parameter, $_REQUEST['id']);
                        if ($msg) {
                            echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close' type='button'>&times;</button>
								   " . "تم التعديل بنجاح" . "
								</div>";
                            if (isset($_POST['profile']))
                                echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=?page=manage_profile\">";
                            else
                                echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=?page=view_users\">";
                        }
                    }
                }
        }
    }


    public function check_email($email)
    {
        $sql = parent::getConnection()->prepare('select * from ' . $this->table . ' where email= ?');
        $sql->execute(array($email));
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($sql->rowCount() != 0) {
            return true;
        }
        //false mean that the email not exist
        return false;
    }

    public function Reset()
    {
        if (isset($_POST["reset_submit"])) {
            if ($this->check_email($_POST['email'])) {
                $user = $this->check_email($_POST['email']);
                $pass = $this->randomPassword();
                $from = parent::GetAttribute('site_email', 'config', 1);
                $to = $_POST['email'];
                $subject = "reset password to " . $_POST['email'];
                $message = "the new password " . $pass . " ";
                $header = "From:" . $from . " \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                mail($to, $subject, $message, $header);
                $parameter['password'] = sha1($pass);
                parent::update($this->table, $parameter, $user);
                echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close' type='button'>&times;</button>
								   " . EMAIL_SEND . "
								</div>";
                echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=login.php\">";
            } else {
                echo "<div class='alert alert-danger'>
								  <button data-dismiss='alert' class='close' type='button'>&times;</button>
								   " . EMSG . "
								</div>";
            }

        }

    }

    function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }

    public
    function DeleteRecord()
    {
        if (isset($_GET["id"]) and isset($_GET["action"]) and $_GET["action"] == "delete") {
            parent::delete($this->table, $_GET['id']);
        }
    }


    public
    function DeleteRecords()
    {
        if (isset($_POST["delete_users"])) {
            if (!isset($_POST["users_box"])) {

                echo "<div class='alert alert-error'>
                              <button data-dismiss='alert' class='close' type='button'>&times;</button>
                                " . "الرجاء اختر واحد على الأقل" . "
               </div>";

            } else {
                foreach ($_POST["users_box"] as $val) {
                    parent::delete($this->table, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";
                echo "<div class='alert alert-success'>
                              <button data-dismiss='alert' class='close' type='button'>&times;</button>
                              " . "تم الحذف بنجاح" . "
               </div>";

            }
        }
    }

    public
    function ActivatedRecords()
    {
        if (isset($_POST["activate_users"])) {
            if (!isset($_POST["users_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 " . "الرجاء اختر واحد على الأقل" . "
							</div>";
            } else {
                foreach ($_POST["users_box"] as $val) {
                    $parameter['active'] = 1;
                    parent::update($this->table, $parameter, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";

                echo "<div class='alert alert-success'>
			 		 								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
			 		 								 " . "تم التفعيل بنجاح" . "
			 		 							</div>";
            }
        }
    }


    public
    function DeactivatedRecords()
    {
        if (isset($_POST["deactivate_users"])) {
            if (!isset($_POST["users_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 " . "الرجاء اختر واحد على الأقل" . "
							</div>";
            } else {
                foreach ($_POST["users_box"] as $val) {
                    $parameter['active'] = 0;
                    parent::Update($this->table, $parameter, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";
                echo "<div class='alert alert-success'>
									 <button data-dismiss='alert' class='close m' type='button'>&times;</button>
										" . "تم إلغاء التفعيل بنجاح" . "
								 </div>";
            }
        }
    }


}

?>
