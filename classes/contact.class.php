<?php
require_once('db.class.php');

class contact extends db
{

    public $table = 'contact';

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
        if (isset($_POST["submit_contact"])) {
            $parameter = [
                'reply' => $_POST["reply"],
                'active' => 1
            ];

            $from = $this->GetAttr('site_email', 1);
            $to = $_POST['email'];
            $subject = "reply to " . $_POST['name'] . "[ " . $_POST['email'] . " ]";
            $message = $_POST['reply'];
            $header = "From:" . $from . " \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            if ($_POST["action"] == "Update") {
                try {
                    $mail = mail($to, $subject, $message, $header);
                    $msg = parent::update($this->table, $parameter, $_GET['id']);

                    if (!empty($mail) and !empty($msg)) {
                        $parameter = [
                            'name' => $_POST['name'],
                            'email' => $_POST['email'],
                        ];
                        parent::insert("newsletter", $parameter);
                    }

                    if ($msg != 0 or !empty($msg)) {
                        if ($_GET['page'] == 'manage_contact_car')
                            $page = 'view_contact_car';
                        else
                            $page = 'view_contact';
                        echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   تمت الرد على الرسالة بنجاح
								</div>";
                        echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=?page=" . $page . "\">";
                    } else {
                        echo "<div class='alert alert-danger'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   يوجد خطأ داخلي
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
        if (isset($_POST["delete_contact"])) {
            if (!isset($_POST["contact_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 " . _SELECT_ERROR . "
							</div>";
            } else {
                foreach ($_POST["contact_box"] as $val) {
                    parent::delete($this->table, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";
                echo "<div class='alert alert-success'>
		 								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
		 								 " . _DELETE_SUCC . "
		 							</div>";
            }
        }
    }


    public function ActivatedRecords()
    {
        if (isset($_POST["activate_contact"])) {
            if (!isset($_POST["contact_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 " . _SELECT_ERROR . "
							</div>";
            } else {
                foreach ($_POST["contact_box"] as $val) {
                    $parameter = ['active' => 1];
                    parent::update($this->table, $parameter, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";

                echo "<div class='alert alert-success'>
			 		 								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
			 		 								 " . SUCCESS_ALL . "
			 		 							</div>";
            }
        }
    }


    public function DeactivatedRecords()
    {
        if (isset($_POST["deactivate_contact"])) {
            if (!isset($_POST["contact_box"])) {
                echo "<div class='alert alert-danger'>
								<button data-dismiss='alert' class='close m' type='button'>&times;</button>
								 " . _SELECT_ERROR . "
							</div>";
            } else {
                foreach ($_POST["contact_box"] as $val) {
                    $parameter = ['active' => 0];
                    parent::update($this->table, $parameter, $val);
                }
                echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";
                echo "<div class='alert alert-success'>
									 <button data-dismiss='alert' class='close m' type='button'>&times;</button>
										" . SUCCESS_ALL . "
								 </div>";
            }
        }
    }


}

?>
