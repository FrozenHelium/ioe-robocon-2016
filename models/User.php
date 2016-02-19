<?php
require_once "ModelObject.php";

class User extends ModelObject
{
    public $username = "default_user_name";
    public $first_name = "DefaultFirstName";
    public $last_name = "DefaultLastName";
    public $privilege = 0;

    public function get_schema() {
        return array(
            array("username", "string"),
            array("first_name", "string"),
            array("last_name", "string"),
            array("privilege", "integer", "max_length"=>1)
        );
    }
}

?>
