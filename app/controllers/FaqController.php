<?php

require_once 'app/models/Faq.php';
require_once 'app/models/Question.php';

class FaqController extends Controller
{
    public function get() {
        $data = array();
        $data["faqs"] = Faq::get_all();
        $data["success"] = isset($_GET["success"]) && $_GET["success"];
        return new TemplateView('faqs.html', $data);
    }

    public function post() {
        $sender_email = $_POST["email"];
        $query = $_POST["query"];

        $question = new Question();
        $question->sender_email = $sender_email;
        $question->query = $query;
        $question->save();

        // GET redirection.
        redirect('faqs/?success=true');
    }
}

 ?>
