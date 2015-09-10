<?php namespace EstTools;

use Illuminate\Support\Facades\Facade;

class EstFacades extends Facade {

    protected static function getFacadeAccessor() { return 'est'; }

}
