<?php
class CAboutUs{
    public static function us(){
        $view = new VAbout();
        $prova = isset( $_POST['Email']);
        $view->about_us($prova);
    }
}