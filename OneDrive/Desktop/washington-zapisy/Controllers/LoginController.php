<?php
class LoginController extends Controller
{
    function process($param)
    {
        session_start();
        $_SESSION["wrong"] = false;
        // header of page
        $this->header["title"] = "Prihlaseni";
        $this->header["description"] = "Prihlaseni pro ucitele";

        $this->data["udaje"] = $_POST;

        if (isset($_POST["heslo"]) && isset($_POST["jmeno"])) {
            $correctPass = Db::singleQuery(
                "SELECT ucitel.heslo FROM wa3rc3ask03.ucitel WHERE ucitel.username = :usr;",
                array(":usr" => $_POST["jmeno"])
            );
            if ($_POST["heslo"] == $correctPass[0]) {
                $_SESSION["user"] = $_POST["jmeno"];
            } else {
                $_SESSION["wrong"] = true;
            }
        }

        // setup layout
        $this->view = "login";
    }
}
