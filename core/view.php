<?php

class View {

    public $content;
    public $data = [];

    function __construct ($content) {
        $this->content = $content;
    }

    public function render($data = []) {
        return $this->content;
    }
    
}