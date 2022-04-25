<?php 
class ErrorController extends Controller{
    function process($param){
        // header request
        header("HTTP:1.0 404 Not Found");
        // header of page
        $this->header["title"] = "Chyba 404";
        $this->header["description"] = "stranka nenalezena";
        // setup layout
        $this->view = "error";
    }
}

