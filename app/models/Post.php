<?php

require_once "../classes/Model.php";

class Post extends Model {
    public function get_schema() {
        return array(
            array("title", "string"),
            array("content", "string"),
            array("created_at", "datetime"),
            array("modified_at", "datetime")
        );
    }

    public function presave() {
        if (!isset($this->created_at)) {
            $this->created_at = new DateTime();
        }
        $this->modified_at = new DateTime();
    }
}

 ?>
