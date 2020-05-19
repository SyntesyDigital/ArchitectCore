<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\ContentField;

class Color extends Field implements FieldInterface
{
    public $type = 'color';
    public $icon = 'fa-paint-brush';
    public $name = 'COLOR';

    public $rules = [
        'required',
    ];

    public $settings = [
      'htmlId',
      'htmlClass',
    ];

    public function save($content, $identifier, $values, $languages = null)
    {
        $content->fields()->save(new ContentField([
            'name' => $identifier,
            'value' => $values,
            'language_id' => null,
        ]));

        return true;
    }
}
