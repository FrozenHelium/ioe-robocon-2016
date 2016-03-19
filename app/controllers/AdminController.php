<?php

require_once 'app/core/session/Auth.php';
require_once 'app/models/User.php';
require_once 'app/models/Faq.php';

class AdminController extends Controller
{
    private function get_admin_data() {
        $data = [];

        $data["faqs"] = Faq::get_all();
        return $data;
    }

    private function get_login_page($error=null) {
        $data = [];

        $data["noadmin"] = count(User::query()->where("privilege=1")->get()) == 0;
        if ($error)
            $data["error"] = $error;
        return new TemplateView('admin-login.html', $data);
    }

    public function get() {
        $user = Auth::get_user('User');

        // Show login page if not logged in or not admin.
        if (!$user || $user->privilege != 1) {
            return $this->get_login_page();
        }

        // Else show admin page.
        return new TemplateView('admin.html', $this->get_admin_data());
    }

    public function post() {

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Authenticate and login.
            $user = User::query()->where("username=?", $username)->first();

            // Check if username is valid and if is admin.
            if (!$user || $user->privilege != 1) {
                return $this->get_login_page("Invalid username");
            }

            // Check for valid password and login.
            // Auth::authenticate does both.
            else if (!Auth::authenticate($user, $password)) {
                return $this->get_login_page("Invalid password");
            }

            // Redirect to show the admin page.
            redirect('admin');
        }
        else if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Create new user and login.
            $user = new User();
            $user->username = $username;
            Auth::set_password($user, $password);
            $user->privilege = 1;
            $user->save();

            Auth::login($user);

            // Redirect to show the admin page.
            redirect('admin');
        }
        else if (isset($_POST['logout'])) {
            Auth::logout();
            redirect('admin');
        }

        else if (isset($_POST['deletefaq'])) {
            $id = $_POST['faq_id'];
            Faq::query()->where("id=?", $id)->delete();
            redirect('admin');
        }

        else if (isset($_POST['savefaq'])) {
            foreach ($_POST as $key=>$value) {
                // Get each faq-question.
                if (strpos($key, "faq-qn-") === 0) {
                    $id = intval(substr($key, strlen("faq-qn-")));

                    // Check if corresponding faq-answer exists.
                    if (isset($_POST["faq-ans-$id"])) {
                        $question = trim($_POST["faq-qn-$id"]);
                        $answer = trim($_POST["faq-ans-$id"]);

                        $faq = Faq::query()->where("id=?", $id)->first();

                        // If question and answer are empty, skip.
                        if ($question == "" && $answer == "") {
                            if ($faq) {
                                // TODO delete $faq
                            }
                            continue;
                        }

                        if (!$faq)
                            $faq = new Faq();

                        $faq->question = $question;
                        $faq->answer = $answer;

                        $faq->save();
                    }
                }
            }
            redirect('admin');
        }
    }
}

 ?>
