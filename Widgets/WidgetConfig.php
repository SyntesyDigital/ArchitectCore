<?php

namespace Modules\Architect\Widgets;

class WidgetConfig
{
    public function __construct()
    {
        $this->widgets = self::get();
    }

    // FIXME : find a better way ! -)
 /*   public static function get()
    {
        $widgets = [];
        foreach (glob(__DIR__ . '/Types/*.php') as $filename){
            $className = sprintf('Modules\Architect\Widgets\Types\%s', str_replace('.php', '', basename($filename)));
            $widget = new $className;

            $widgets[$widget->name] = [
                'class' => $className,
                'rules' => $widget->getRules(),
                'label' => $widget->getName(),
                'name' => trans('architect::widgets.' . $widget->getName()),
                'type' => $widget->getType(),
                'icon' => $widget->getIcon(),
                'settings' => $widget->getSettings() ?: null,
                'fields' => $widget->getFields(),
                'component' => $widget->getComponent(),
                'widget' => $widget->getWidget(),
                'hidden' => $widget->getHidden(),
                'defaultSettings' => $widget->getDefaultSettings()
            ];
        }

        return $widgets;
    }*/


    public static function getConfigFile()
    {
        return self::getBasePath() . 'widgets.json';
    }

    public static function getBasePath()
    {
        return base_path() . '/Widgets/';
    }


    public static function get()
    {
        $widgets = [];
        $widgetList = json_decode(file_get_contents(self::getConfigFile()));

        if($widgetList) {
            foreach($widgetList as $w) {
                $className = sprintf('Widgets\%s\%s', $w->name, $w->name);
                $widget = new $className;

                $widgets[$widget->name] = [
                    'class' => $className,
                    'widget' => $widget->getWidget(),
                    'rules' => $widget->getRules(),
                    'label' => $widget->getName(),
                    'name' => trans('widgets::' . $widget->getName() . '.name'),
                    'type' => $widget->getType(),
                    'icon' => $widget->getIcon(),
                    'settings' => $widget->getSettings() ?: null,
                    'fields' => $widget->getFields(),
                    'component' => $widget->getComponent(),
                    'hidden' => $widget->getHidden(),
                    'defaultSettings' => $widget->getDefaultSettings(),
                    'base_path' => self::getBasePath() . $widget->getName() . '/'
                ];
            }
        }

        return $widgets;
    }
}
?>
