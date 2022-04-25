<?php
class RozvrhTridController extends Controller
{
    function process($param)
    {

        // header of page
        $this->header["title"] = "Rozvrh";
        $this->header["description"] = "Rozvrhy trid";

        #$this->data["schedule"] = $_POST;


        // setup layout
        $this->view = "rozvrhTrid";
    }
}
