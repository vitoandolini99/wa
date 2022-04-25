<?php 
class VytvorClanekController extends Controller{
    function process($param){

        //header
        $this->header["title"] = "Vytvoreni clanku";
        $this->header["description"] = "Na teto strance se ukladaji clanky do databaze";
        $this->data["articles"] = ArticleManager::getAllArticles();

        $this->data["formular"] = $_POST;

        if(!empty($_POST["title"]))
        {
            $article = new Article($_POST["title"], $_POST["content"]);
            if(!empty($_POST["key_words"]))
            {
                $article->setKeys($_POST["key_words"]);
            }
            if(!empty($_POST["image"]))
            {
                $article->setImage($_POST["image"]);
            }

            ArticleManager::insertArticle($article);
        }

        // setup layout
        $this->view = "vytvorclanek";

    }
}