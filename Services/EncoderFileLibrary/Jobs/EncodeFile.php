<?php

namespace Modules\Extranet\Services\ElementModelLibrary\Jobs;

class EncodeFile
{
    //  use FormFields;

    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
      ]);
    }

    public function handle()
    {
        return;
    }
}
