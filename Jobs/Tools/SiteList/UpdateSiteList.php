<?php

namespace Modules\Architect\Jobs\Tools\SiteList;

use Modules\Architect\Http\Requests\Tools\SiteList\UpdateSiteListRequest;
use Modules\Architect\Entities\Tools\SiteList;

class UpdateSiteList
{
    private $fields = [
            'identifier',
            'name',
            'type',
            'value',
    ];

    public function __construct(SiteList $sitelist, array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
        $this->sitelist = $sitelist;
        $options = json_decode($attributes['value']);
        foreach ($options as $key => $option) {
          $options[$key]->value = trim($option->value);
        }
        $this->attributes['value'] = json_encode($options);
    }

    public static function fromRequest($sitelist, UpdateSiteListRequest $request)
    {
        return new self($sitelist, $request->all());
    }

    public function handle()
    {
        $this->sitelist->update($this->attributes);

        return true;
    }
}
