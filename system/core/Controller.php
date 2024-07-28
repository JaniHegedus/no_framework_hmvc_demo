<?php

class Controller {
    protected $module = '';

    public function __construct($module = '') {
        $this->module = $module;
    }

    public function loadModel($model) {
        $modelPath = "application/models/$model.php";
        if (file_exists($modelPath)) {
            require_once $modelPath;
        } else {
            // Check if model exists in the module
            $moduleModelPath = "application/modules/{$this->module}/models/$model.php";
            if (file_exists($moduleModelPath)) {
                require_once $moduleModelPath;
            } else {
                die("Model $model not found!");
            }
        }
        $this->$model = new $model;
    }

    public function loadView($view, $data = []) {
        extract($data);
        $viewPath = "application/views/$view.php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            // Check if view exists in the module
            $moduleViewPath = "application/modules/{$this->module}/views/$view.php";
            if (file_exists($moduleViewPath)) {
                require_once $moduleViewPath;
            } else {
                die("View $view not found!");
            }
        }
    }
}
