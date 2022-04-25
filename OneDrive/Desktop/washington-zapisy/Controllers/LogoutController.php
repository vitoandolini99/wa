<?php
class LogoutController extends Controller
{
    function process($param)
    {

        // header of page
        $this->header["title"] = "Logging out";
        $this->header["description"] = "Log out";

        // setup layout
        $this->view = "logout";
    }
}
