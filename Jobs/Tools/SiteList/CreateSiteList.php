<?php

namespace Modules\Architect\Jobs\Tools\SiteList;

use Modules\Architect\Http\Requests\Tools\SiteList\CreateSiteListRequest;
use Modules\Architect\Entities\Tools\SiteList;

class CreateSiteList
{
    public function __construct(array $attributes = [])
    {
        $options = json_decode($attributes['value']);
        foreach ($options as $key => $option) {
          $options[$key]->value = trim($option->value);
        }

        $this->attributes = array_only($attributes, [
            'identifier',
            'name',
            'type',
            'value',
        ]);
        $this->attributes['value'] = json_encode($options);
    }

    public static function fromRequest(CreateSiteListRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        return SiteList::create($this->attributes);
    }
}
