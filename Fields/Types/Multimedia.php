<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;
use Modules\Architect\Fields\Field;

class Multimedia extends Field implements FieldInterface
{
    public $type = 'multimedia';
    public $icon = 'fa-id-card-o';
    public $name = 'MULTIMEDIA';

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass'
    ];
}
?>
