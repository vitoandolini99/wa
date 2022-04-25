<?php
class ClanekController extends Controller
{
    function process($param)
    {
        if (!empty($params[0])) {
        }
        $this->header["title"] = "Domovina";
        $this->header["description"] = "Domovina tohoto webu";
        $this->data["articles"] = ArticleManager::getAllArticles();
        // setup layout
        $this->view = "domov";
    }
}
