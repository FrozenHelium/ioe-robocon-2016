<?php

require_once 'app/models/Faq.php';

class FaqController extends Controller
{
    public function get() {
        $data = array();
        $data["faqs"] = Faq::get_all();
        return new TemplateView('faqs.html', $data);
    }
}

 ?>
