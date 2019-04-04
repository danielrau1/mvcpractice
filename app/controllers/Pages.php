<?php
class Pages extends Controller
{

    public function __construct(){}

    public function mainNavPage()
    {


        require 'C:\xampp\htdocs\mvcpractice\app\views\navbar.php';
    }

    public function page1()
    {
        require 'C:\xampp\htdocs\mvcpractice\app\views\page1.php';;
    }

    public function users()
    {
        require 'C:\xampp\htdocs\mvcpractice\app\views\users.php';;
    }

    public function login()
    {
        require 'C:\xampp\htdocs\mvcpractice\app\views\login.php';;
    }

}