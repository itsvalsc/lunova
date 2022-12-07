<?php
class CAboutUs{
    public static function us(){
        $view = new VAbout();
        $prova = ( $_POST['Email']);
        $view->about_us($prova);
    }
}