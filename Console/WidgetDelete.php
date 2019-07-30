<?php

namespace Modules\Architect\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Widgets\Config;
use Modules\Architect\Widgets\WidgetConfig;
use File;

class WidgetDelete extends Command
{


    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'architect:widget-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Architect delete widget';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Remove Widget directory
        $this->rrmdir($this->getWidgetPath());

        // Remove Widget from the config
        $this->rebuildConfig();

        // Remove Translation files
        $this->removeTranslations();
    }


    public function removeTranslations()
    {
        $langDirPath = WidgetConfig::getBasePath() . 'lang/';
        $objects = scandir($langDirPath);

        foreach($objects as $object) {
            if ($object != "." && $object != "..") {
                $file = $langDirPath . $object . '/' . $this->getWidgetName() . '.php';

                if(is_file($file)) {
                    unlink($file);
                }
            }
        }
    }


    public function rebuildConfig()
    {
        $configJson = json_decode(file_get_contents($this->getConfigFile()));

        $arr = [];
        foreach($configJson as $widget) {
            if($widget->name !== $this->getWidgetName()) {
                $arr[] = $widget;
            }
        }

        file_put_contents(
            $this->getConfigFile(),
            json_encode($arr, JSON_PRETTY_PRINT)
        );
    }

    public function getWidgetPath()
    {
        return WidgetConfig::getBasePath() . $this->getWidgetName() . '/';
    }

    public function getConfigFile()
    {
        return WidgetConfig::getConfigFile();
    }

    public function getWidgetName()
    {
        return str_replace(' ', '', $this->argument('name'));
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Name of the widget'],
        ];
    }


    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") {
                        rrmdir($dir."/".$object);
                    } else {
                        unlink($dir."/".$object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}
