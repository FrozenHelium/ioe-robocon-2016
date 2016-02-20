<?php
require_once "../classes/ModelObject.php";

class User extends ModelObject
{
    // When schema is not defined explicitly, it is automatically
    // deduced from the properties of the first User object that is saved.

    public $username = "default_user_name";
    public $first_name = "DefaultFirstName";
    public $last_name = "DefaultLastName";
    public $privilege = 0;

    // Optionally, one may define the schema as follows.
    // Explicitly defining the schema has certain advantages:
    //
    // * One can specify further attributes for SQL fields like max_length
    // * One can set properties for a Model which are not fields in schema
    //
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
