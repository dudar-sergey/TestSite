<?php
include_once 'DataBase.php';



class PostEntity
{
    private $id;
    private $title;
    private $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function AddPost($title, $content)
    {

    }
    public function DeletePost($id)
    {

    }



}