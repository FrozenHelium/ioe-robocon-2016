<?php

class Faq extends Model {

    public function get_schema() {
        return [
            ["question", "string"],
            ["answer", "string"]
        ];
    }
}

?>
