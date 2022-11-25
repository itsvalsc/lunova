<?php
class CRicercaDisco{
    public static function index(){
        $viewex = new VHome();
        FSessione::start();
        $logged = true;
        $viewex->ShowIndex($logged);
    }
}