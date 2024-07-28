<?php
require_once 'system/core/Controller.php';

class BlogController extends Controller {
    public function __construct($module = '') {
        parent::__construct($module);
    }

    public function index() {
        $this->loadModel('BlogModel');
        $data['posts'] = $this->BlogModel->getPosts();
        $this->loadView('blog/index', $data);
    }
}
