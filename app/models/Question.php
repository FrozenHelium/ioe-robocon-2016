<?php

class Question extends Model {

    public function get_schema() {
        return [
            ["sender_email", "String"],
            ["query", "Text"]
        ];
    }
}

 ?>
