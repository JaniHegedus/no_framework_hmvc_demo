<?php
require_once 'system/core/Model.php';

class BlogModel extends Model {
    public function getPosts() {
        // Example data
        return [
            ['title' => 'First Post', 'content' => 'This is the first post.'],
            ['title' => 'Second Post', 'content' => 'This is the second post.']
        ];
    }
}
