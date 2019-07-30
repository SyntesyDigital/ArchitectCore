<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class HomeHeader extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-picture-o';
    public $name = 'HOME_HEADER';
    public $component = 'CommonWidget';

    public $fields = [
        'image_1' => 'Modules\Architect\Fields\Types\Image',
        'image_2' => 'Modules\Architect\Fields\Types\Image',
        'image_mobile_1' => 'Modules\Architect\Fields\Types\Image',
        'image_mobile_2' => 'Modules\Architect\Fields\Types\Image',
        'title' => 'Modules\Architect\Fields\Types\RichText',
        'subtitle' => 'Modules\Architect\Fields\Types\RichText',
        'link_survey' => 'Modules\Architect\Fields\Types\Link',
        'link_cat' => 'Modules\Architect\Fields\Types\Link',
        'link_dog' => 'Modules\Architect\Fields\Types\Link'
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass',
        'cropsAllowed',
    ];

}
?>
