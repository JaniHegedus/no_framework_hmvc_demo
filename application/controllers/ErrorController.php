<?php

class ErrorController {
    public function notFound($message) {
        echo "<h1>404 Not Found</h1>";
        echo "<p>$message</p>";
    }
}

