<?php
require_once 'system/core/Model.php';

class HomeModel extends Model {
    public function getMessage() {
        return 'Hello, world!';
    }
}
