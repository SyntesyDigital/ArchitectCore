<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class LogoText extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-picture-o';
    public $name = 'LOGO_TEXT';
    public $component = 'CommonWidget';

    public $fields = [
        'image' => 'Modules\Architect\Fields\Types\Image',
        'description' => 'Modules\Architect\Fields\Types\RichText'
    ];

    public $rules = [
        'required'
    ];

    public $hidden = true;

    public $settings = [
        'htmlId',
        'htmlClass',
        'cropsAllowed',
    ];

}
?>
