<?php

namespace Module\Cms\Http\Controllers\Web;

class ContactController extends \Module\Contact\Http\Controllers\Web\ContactController
{
    public function index()
    {
        return view('cms::web.page.contact');
    }
}
