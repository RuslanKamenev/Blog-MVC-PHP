<?php

class HeaderController extends Controller {

    public function index() {

        $headerModel = $this->loadModel();
        $searchData =$_POST['search'];
        if ( isset($searchData) ) {
            $headerModel->searchPost($searchData);
            exit();
        }
    }

}