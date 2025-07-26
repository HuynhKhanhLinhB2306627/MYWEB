<?php
namespace App\Controllers;

class ErrorController {

    public function sendNotFound()
    {
        http_response_code(404);
        render('404');
    }
}
