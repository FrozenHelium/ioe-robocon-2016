<?php
require_once '../models/User.php';

class HomeController extends Controller
{
    public function get()
    {
        // Get all users
        // $users = User::get();

        // Filter users (unsafe)
        // $users = User::get("first_name='Bibek' AND last_name='Dahal'");

        // Filter users (safe)
        $users = User::get("first_name=? AND last_name=?", "Bibek", "Dahal");
        foreach ($users as $user) {
            var_dump($user);
        }

        return new View($this->model, 'home.html');
    }

    // Try url /home/cool/Bibek/Dahal/
    // Then check out the index of new user from phpmyadmin
    // Then try url /home/cool/Not_Bibek/Not_Dahal/<id>
    public function get_cool($a="", $b="", $id=null)
    {
        echo "User added: $a $b<br>";
        $user = new User();
        if ($id) {
            $user->id = intval($id);
        }
        $user->first_name = $a;
        $user->last_name = $b;

        // Since we explicitly define the schema in User class
        // and it doesn't contain the "undefined_field",
        // following is perfectly safe to do and it will NOT be
        // saved in the table when save() is called.
        $user->undefined_field = 100;

        $user->save();

        return new View($this->model, 'rules.html');
    }
}

?>
