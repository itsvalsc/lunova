<?php
class CSondaggi{
    public static function show(){
        $view = new VSondaggi();
        $l = true;
        $view->show($l);
    }
}
