<?php
require_once '../models/User.php';

class HomeController extends Controller
{
    public function get()
    {
        // Get all users
        // $users = User::get_all();
        // $users = User::query()->get();

        // Raw query
        // $users = User::raw_query("SELECT * FROM user WHERE first_name='Bibek' AND last_name='Dahal'");

        // Query-Builder: Filter users (unsafe)
        // $users = User::query()->where("first_name='Bibek' AND last_name='Dahal'")->get();

        // Query-Builder: Filter users (safe)
        $users = User::query()->where("first_name=? AND last_name=?", "Bibek", "Dahal")->get();

        // Query-Builder: Filter and project only the last name
        // $users = User::query()->where("first_name=?", "Bibek")->select("last_name")->get();

        foreach ($users as $user) {
            var_dump($user);

            // We can modify and save the model objects returned from query
            // $user->privilege = 1;
            // $user->save();
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
