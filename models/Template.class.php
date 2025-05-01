<?php
class Template {
    private $template_file;
    private $template_vars = array();

    public function __construct($template_file) {
        $this->template_file = $template_file;
    }

    public function set($var_name, $var_value) {
        $this->template_vars[$var_name] = $var_value;
    }

    public function render() {
        if (file_exists($this->template_file)) {
            $template = file_get_contents($this->template_file);
            foreach ($this->template_vars as $key => $value) {
                $template = str_replace("{{" . $key . "}}", $value, $template);
            }
            return $template;
        } else {
            return "Error: Template file not found!";
        }
    }
}