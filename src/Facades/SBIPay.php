<?php

namespace JagdishJP\SBIPay\Facades;

use Illuminate\Support\Facades\Facade;

class SBIPay extends Facade
{
    protected static function getFacadeAccessor(){ return 'sbi-pay'; }
}
