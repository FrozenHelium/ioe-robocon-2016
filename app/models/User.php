<?php

class User extends Model {

    public function get_schema() {
        return [
            ["username", "string", "extra"=>"UNIQUE"],
            ["password", "string", "max_length"=>255],
            ["privilege", "integer", "max_length"=>3],
            ["created_at", "datetime"]
        ];
    }

    // default values
    public $privilege = 0;  // 0 == normal 1 == admin

    public function presave() {
        if (!isset($this->created_at)) {
            $this->created_at = new DateTime();
        }
    }
}

 ?>
