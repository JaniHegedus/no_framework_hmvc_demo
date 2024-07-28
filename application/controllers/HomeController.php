<?php
require_once 'system/core/Controller.php';

class HomeController extends Controller {
    public function index() {
        $this->loadModel('HomeModel');
        $data['message'] = $this->HomeModel->getMessage();
        $this->loadView('index', $data);
    }
}
