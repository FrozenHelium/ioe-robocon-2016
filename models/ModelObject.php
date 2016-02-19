<?php

require_once '../classes/Database.php';

function to_snake_case($input) {
    preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match) {
        $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
    }
    return implode('_', $ret);
}

function get_sql_type($type, $max_length=null) {
    switch (strtolower($type)) {
        case 'integer':
            if (!$max_length)
                $max_length = 11;
            return "INT($max_length)";
        case 'string':
            if (!$max_length)
                $max_length = 30;
            return "VARCHAR($max_length)";
        case 'boolean':
            return "BOOL";
        default:
            return null;
    }
}

function get_item($array, $key, $default=null) {
    if ($array && key_exists($key, $array))
        return $array[$key];
    return $default;
}

class ModelObject
{
    protected $db;

    public function __construct() {
        $this->db = Database::get_instance();
    }

    public function get_schema() {
        return array();
    }

    public function get_table_name() {
        return to_snake_case(get_class($this));
    }

    public function exists() {
        $res = $this->db->query("SHOW TABLES LIKE '" . $this->get_table_name() . "'");
        return $res->num_rows > 0;
    }

    public function create_table() {
        if ($this->exists())
            return;
        // TODO: Use prepare and bind

        $sql = "CREATE TABLE IF NOT EXISTS " . $this->get_table_name() . " (";

        $primary_key = "id";
        $sql .= " $primary_key INT AUTO_INCREMENT PRIMARY KEY";

        $schema = $this->get_schema();
        foreach ($schema as $item) {
            $name = $item[0];
            $len = get_item($item, "max_length", null);
            $type = get_sql_type($item[1], $len);

            if ($type && $name)
                $sql .= ", $name $type NOT NULL";
        }

        $sql .= ")";

        $res = $this->db->query($sql);
        if ($res === false)
            die($this->db->error . "<br>" . $sql);
    }


    public function save() {
        // TODO: Do not always create table
        $this->create_table();

        $reflect = new ReflectionObject($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

        // TODO: Use prepare and bind
        $keys = "";
        $values = "";
        $update_string = "";
        foreach ($props as $prop) {
            $name = $prop->getName();
            $val = $prop->getValue($this);

            if ($keys!="")
                $keys .= ",";
            $keys .= "$name";

            if ($values!="")
                $values .= ",";
            $values .= "'$val'";

            if ($update_string!="")
                $update_string .= ",";
            $update_string .= "$name='$val'";
        }

        $sql = "INSERT INTO " . $this->get_table_name() . " ($keys) VALUES($values) "
            . " ON DUPLICATE KEY UPDATE $update_string";

        $res = $this->db->query($sql);
        if ($res === false)
            die($this->db->error . "<br>" . $sql);
    }
}

?>
