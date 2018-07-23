<?php
/**
 * Created by PhpStorm.
 * User: Algeneral
 * Date: 7/17/2018
 * Time: 1:16 PM
 */
(new Controller())->index();

class Controller
{
    public function index()
    {
        include "wizard/steps/step{$_SESSION['step']}.php";
    }


    public function saveUserData()
    {
        if (isset($_POST['saveUser'])) {
            $fullName = $_POST['fullName'];
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            $email = $_POST['email'];
            $data = "fullName=" . $fullName . "\n" .
                "username=" . $username . "\n" .
                "password=" . $password . "\n" .
                "email=" . $email . "\n" .
                "date=" . 'now()';
            try {
                file_put_contents("wizard/user.txt", $data);
            } catch (Exception $exception) {
                echo "حدث خطأ, الرجاء المحاولة لاحقا";
            }
            $this->nextStep();
            unset($_POST['saveUser']);
            $_SESSION['success'] = "تم اضافة المستخدم";
            refresh();
        }
    }

    private function nextStep()
    {
        $_SESSION['step'] = $_SESSION['step'] + 1;
        $step_file = "wizard/step_value.txt";
        file_put_contents($step_file, $_SESSION['step']);
    }

    public function createClasses()
    {
        $menuItemsHtml = "";
        if (isset($_POST['createClasses'])) {
            foreach ($_POST['className'] as $key => $class) {
                $createManage = false;
                $createView = false;
                $this->createClass($class);
                if ($_POST['manage'][$key] == 1) {
                    $this->createManage($class);
                    $createManage = true;
                }
                if ($_POST['view'][$key] == 1) {
                    $this->createView($class);
                    $createView = true;
                }
                $menuItemsHtml .= $this->createMenuItems($class, $createView, $createManage);
            }
            $this->finishWizard($menuItemsHtml);
        }
    }

    private function createClass($name)
    {
        $file = file_get_contents("wizard/CloneableFiles/cloneClass.php");
        $file = str_replace('cloneClass', $name, $file);
        file_put_contents("classes/{$name}.class.php", $file);
    }

    private function createView($name)
    {
        $file = file_get_contents("wizard/CloneableFiles/cloneView.php");
        $file = str_replace('cloneClass', $name, $file);
        $file = str_replace('classObject', $name . "Object", $file);
        file_put_contents("pages/view_{$name}.php", $file);
    }

    private function createManage($name)
    {
        $file = file_get_contents("wizard/CloneableFiles/cloneManage.php");
        $file = str_replace('cloneClass', $name, $file);
        $file = str_replace('classObject', $name . "Object", $file);
        file_put_contents("pages/manage_{$name}.php", $file);
    }

    private function createMenuItems($name, $createView, $createManage)
    {
        $view = $createView == true ? ' <li class="site-menu-item">
                                                <a class="animsition-link" href="?page=view_' . $name . '">
                                                    <span class="site-menu-title">' . $name . 'عرض' . '</span>
                                                </a>
                                            </li>' : "";
        $manage = $createManage == true ? ' <li class="site-menu-item">
                                                <a class="animsition-link" href="?page=manage_' . $name . '&action=insert">
                                                    <span class="site-menu-title">' . $name . 'التحكم' . '</span>
                                                </a>
                                            </li>' : "";
        $menuItemHtml = '<li class="dropdown site-menu-item has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                            <span class="site-menu-title">' . $name . '</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="site-menu-scroll-wrap is-list">
                                <div>
                                    <div>
                                        <ul class="site-menu-sub site-menu-normal-list">
                                           ' . $view . '
                                            ' . $manage . '
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>';
        return $menuItemHtml;

    }

    private function finishWizard($menuItemsHtml)
    {
        $indexHtml = file_get_contents("wizard/CloneableFiles/index.php");
        $indexHtml = str_replace('$items', $menuItemsHtml, $indexHtml);
        file_put_contents("index.php", $indexHtml);
        $this->createTables();
        $this->addUserToDB();
        $this->deleteWizardFiles();
        sleep(0.05);
        refresh();
    }

    private function createTables()
    {
        $sql = file_get_contents('wizard/tables.sql');
        db::getConnection()->exec($sql);
    }

    private function addUserToDB()
    {
        $userData = explode("\n", file_get_contents("wizard/user.txt"));
        foreach ($userData as $userDatum) {
            $user[explode('=', $userDatum)[0]] = explode('=', $userDatum)[1];
        }
        db::insert('users', $user);
    }

    public function deleteWizardFiles()
    {
        $wizardDirectory = "wizard/";
        //delete files in wizard
        $this->deleteFiles($wizardDirectory);
        //delete directories and it's files in wizard
        $this->deleteDirectoriesFiles($wizardDirectory);
        //remove wizard directory
        rmdir($wizardDirectory);
    }

    private function deleteFiles($wizardDirectory)
    {
        $directories = scandir($wizardDirectory);
        //remove . and .. from array
        unset($directories[0], $directories[1]);
        //remove all files from directory
        array_map('unlink', glob("$wizardDirectory/*.*"));
    }

    private function deleteDirectoriesFiles($wizardDirectory)
    {
        //get rest directories in wizard directory
        $directories = scandir($wizardDirectory);
        //remove . and .. from array
        unset($directories[0], $directories[1]);
        foreach ($directories as $directory) {
            array_map('unlink', glob("$wizardDirectory/$directory/*.*"));
            rmdir($wizardDirectory . '' . $directory);
        }
    }

}
