<?php
class ZapisController extends Controller
{
    function process($param)
    {
        session_start();
        // header of page
        $this->header["title"] = "Zápis";
        $this->header["description"] = "Zápis do třídní knihy";
        #$this->data["hodina"] = $_GET;

        if (isset($_GET["skupina"])) {
            $this->data["hodina"] = Db::singleQuery(
                "SELECT trida,skupina,hodina,den,jmeno,prijmeni,predmet,hodina.mistnost
                 FROM wa3rc3ask03.trida INNER JOIN wa3rc3ask03.hodina ON trida.id = hodina.trida INNER JOIN wa3rc3ask03.ucitel ON ucitel.id = hodina.ucitel_id 
                 WHERE trida.id = :tridaId AND hodina.den = :hodinaDen AND hodina.hodina = :hodinaHodina AND hodina.skupina = :hodinaSkupina;",
                array(":tridaId" => $_GET["trida"], ":hodinaDen" => $_GET["den"], ":hodinaHodina" => $_GET["hodina"], ":hodinaSkupina" => $_GET["skupina"])
            );
            $this->data["studenti"] = Db::query(
                "SELECT jmeno, prijmeni
                 FROM student
                 WHERE trida_id = :trida AND skupina = :skupina
                 ORDER BY prijmeni, jmeno;",
                array(":trida" => $_GET["trida"], ":skupina" => $_GET["skupina"])
            );
        } else {
            $this->data["hodina"] = Db::singleQuery(
                "SELECT trida,skupina,hodina,den,jmeno,prijmeni,predmet,hodina.mistnost
                 FROM wa3rc3ask03.trida INNER JOIN wa3rc3ask03.hodina ON trida.id = hodina.trida INNER JOIN wa3rc3ask03.ucitel ON ucitel.id = hodina.ucitel_id 
                 WHERE trida.id = :tridaId AND hodina.den = :hodinaDen AND hodina.hodina = :hodinaHodina",
                array(":tridaId" => $_GET["trida"], ":hodinaDen" => $_GET["den"], ":hodinaHodina" => $_GET["hodina"])
            );
            $this->data["studenti"] = Db::query(
                "SELECT jmeno, prijmeni
                 FROM student
                 WHERE trida_id = :trida 
                 ORDER BY prijmeni, jmeno;",
                array(":trida" => $_GET["trida"])
            );
        }






        // setup layout
        $this->view = "zapis";
    }
}
