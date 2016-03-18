<?php

class Post extends Model {

    public function get_schema() {
        return [
            ["title", "string"],
            ["content", "string"],
            ["created_at", "datetime"],
            ["modified_at", "datetime"]
        ];
    }

    public function presave() {
        if (!isset($this->created_at)) {
            $this->created_at = new DateTime();
        }
        $this->modified_at = new DateTime();
    }
}

 ?>
