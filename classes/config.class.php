<?php
require_once('db.class.php');

class config extends db
{

    public $table = 'config';

    public function __construct()
    {

    }


    public function GetLastRecords()
    {
        $data = parent::LastRecord($this->table);

        if (count($data) > 0) {
            return $data;
        } else {
            return "0";
        }
    }


    public function GetAllRecords($id = null)
    {
        $where = $id != null ? " and C.id=:id " : null;
        $sql = sprintf("select C.* , L.name as lang_name , U.fullname as user_name 
                               from config C 
                               join langs L on L.id = C.lang_id
                               join users U on U.id = C.user_id
                               where C.active != -1 %s
                               ORDER by C.id asc", $where);
        return db::FetchQuery($sql, $id);
    }


    public function GetAllPages($id)
    {

        $sql = sprintf("select * from %s where active = 1 and lang =:id  ORDER by id asc", 'pages');
        return parent::FetchQuery($sql, $id);

    }

    public function GetAttr($attribute, $indicator)
    {
        return parent::GetAttribute($attribute, $this->table, $indicator);

    }


    public function EditRecord()
    {

        $validator = new GUMP('ar');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $parameters = [
                'site_name' => $_POST["site_name"],
                'site_owner' => $_POST["site_owner"],
                'site_url' => $_POST["site_url"],
                'description' => $_POST["description"],
                'site_email' => $_POST["site_email"],
                'lang_id' => 1,
                'active' => 1,
                'user_id' => $_SESSION['User_ID'],
                'date' => date('Y-m-d H:i:s'),
                'fax' => $_POST["fax"],
                'mobile' => $_POST["mobile"],
                'phone' => $_POST["phone"],
                'address' => $_POST["address"] ?? ' s',
                'fb' => $_POST["fb"],
                'tw' => $_POST["tw"],
                'yt' => $_POST["yt"],
            ];
            $rules = array(
                'site_name' => 'required',
                'site_owner' => 'required',
                'description' => 'required',
                'site_email' => 'required',
            );
            $validated = $validator->validate($parameters, $rules);
            if ($validated !== TRUE) {
                $error = $validator->get_readable_errors(true);
                echo "<div class='alert alert-danger'>
						 <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								$error
					  </div>";
                return 0;
            }

            if ($_POST["action"] == "Update") {

                $msg = parent::update($this->table, $parameters, $_GET['id']);
                if ($msg != 0 or !empty($msg)) {
                    echo "<div class='alert alert-success'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								     تمت عملية التعديل بنجاح
								</div>";
                    echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=?page=view_config\">";
                } else {
                    echo "<div class='alert alert-danger'>
								  <button data-dismiss='alert' class='close m' type='button'>&times;</button>
								   يوجد خطأ داخلي
								</div>";
                }
            }
        }
    }
}

?>
