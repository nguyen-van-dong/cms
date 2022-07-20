<?php

namespace Module\Cms\Facades;

use Illuminate\Support\Facades\Facade;

class Page extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cms.page';
    }
}
