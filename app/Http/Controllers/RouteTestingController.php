<?php

namespace App\Http\Controllers;

class RouteTestingController extends Controller
{
    public function lang()
    {
        return __('messages.bitsense_welcome', ['user' => 'sid']);
    }

    public function chiSiamo()
    {
        return view('chi-siamo');
    }

    public function testNamespace()
    {
        return 'testNamespace';
    }

    public function users($id = null)
    {
        if ($id) {
            return 'user id: ' . $id;
        }

        return 'id is null';
    }
}
