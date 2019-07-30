<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Recipes extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-picture-o';
    public $name = 'RECIPES';
    public $component = 'CommonWidget';

    public $fields = [
        'contents' => 'Modules\Architect\Fields\Types\Contents',
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass',
        'cropsAllowed',
        'typologyAllowed'
    ];

    public $defaultSettings = [
      'typologyAllowed' => 1
    ];

}
?>
