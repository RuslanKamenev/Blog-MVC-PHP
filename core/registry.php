<?php

class Registry {

    public $url;
    public $appUrl;
    public $dict;
    public $authorise;
    public $errors;

    public function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
    }
}