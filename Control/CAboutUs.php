<?php
class CAboutUs{
    public static function us(){
        $view = new VAbout();
        $l = true;
        $view->about_us($l);
    }
}