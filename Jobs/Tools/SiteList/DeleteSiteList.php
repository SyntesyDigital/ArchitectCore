<?php

namespace Modules\Architect\Jobs\Tools\SiteList;

use Modules\Architect\Entities\Tools\SiteList;

class DeleteSiteList
{
    public function __construct(SiteList $siteList)
    {
        $this->siteList = $siteList;
    }

    public function handle()
    {
        return $this->siteList->delete() > 0 ? true : false;
    }
}
