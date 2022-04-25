<?php
class DomovController extends Controller
{
    function process($param)
    {
        session_start();
        // header of page
        $this->header["title"] = "Domov";
        $this->header["description"] = "Domov";
        $this->data["teacherIds"] = Db::query("SELECT zkratka 
                                               FROM wa3rc3ask03.ucitel;");

        $days = [
            1 => "po",
            2 => "út",
            3 => "st",
            4 => "čt",
            5 => "pá"
        ];

        for ($i = 1; $i <= 5; $i++) {
            $this->data["day"][$i] = Db::query(
                "SELECT den,hodina,mistnost,predmet,trida,skupina,zkratka
                     FROM wa3rc3ask03.ucitel INNER JOIN wa3rc3ask03.hodina ON ucitel.id = hodina.ucitel_id
                     WHERE ucitel.username = :teacher AND hodina.den = $i;",
                array(":teacher" => $_SESSION["user"])
            );
        }

        $this->data["days"] = $days;
        // setup layout
        $this->view = "domov";
    }
}
