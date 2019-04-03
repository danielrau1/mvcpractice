<?php
class Controller{
    // (B1.1) will include 2 methods - models and views

    //(B2) Load model
    public function model($model){
        // (B2.1) require the model file
        require_once '../app/models/'.$model.'.php';
        //(B2.2) instantiate the model
        return new $model(); // so if Post is passedit will return new Posts();
    }

    //(B3) Load view
    public function view($view, $data=[]){
        // (B3.1) check for the view file
        if(file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/'.$view.'.php';
        } else{
            // view deosn't exist
            die('View doesnt exist');
        }
    }


    public function index(){


        require 'C:\xampp\htdocs\mvcpractice\app\views\navbar.php';
    }

    public function page1(){
        require 'C:\xampp\htdocs\mvcpractice\app\views\page1.php';;
    }

}