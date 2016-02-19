<?php

require_once '../config.php';

class Template
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function process($model)
    {
        $content = file_get_contents(ROOTDIR.'/views/'.$this->file);

        $var_regx = "[\{\{(.*)\}\}]";
        if(preg_match_all($var_regx, $content, $matches))
        {
            for($i=0; $i < count($matches[0]); $i++ )
            {
                $key = trim($matches[1][$i]);
                $content = str_replace($matches[0][$i],
                    array_key_exists($key, $model->data)? $model->data[$key] : "",
                    $content);
            }
        }
        echo $content;
    }
}

?>
