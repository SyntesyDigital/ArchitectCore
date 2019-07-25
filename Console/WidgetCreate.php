<?php

namespace Modules\Architect\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Widgets\Config;
use Modules\Architect\Widgets\WidgetConfig;

class WidgetCreate extends Command
{
    protected $template = [
        'Widget.js',
        'Widget.php',
        'Widget.scss',
        [
            'src' => 'main.blade.php',
            'out' => 'main.blade.php'
        ],
    ];

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'architect:widget-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Architect create new widget';

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
        if ($this->createDir()) {
            $this->createFiles();
            $this->writeConfig();
        }
    }


    public function getWidgetName()
    {
        return str_replace(' ', '', $this->argument('name'));
    }

    public function getWidgetPath()
    {
        return WidgetConfig::getBasePath() . $this->getWidgetName() . '/';
    }

    public function getConfigFile()
    {
        return WidgetConfig::getConfigFile();
    }

    /**
     * Create widget directory
     *
     * @return bool
     */
    public function createDir()
    {
        if (!is_dir($this->getWidgetPath())) {
            if (mkdir($this->getWidgetPath(), 0755)) {
                return true;
            }
        } else {
            $this->error('Widget already exist, please check ' . $this->getWidgetPath() . ' directory');
        }

        return false;
    }

    public function getTemplateContent($tpl)
    {
        return str_replace(
            '{name}',
            $this->getWidgetName(),
            file_get_contents(base_path() . '/Widgets/template/' . $tpl)
        );
    }


    /*
     * Copy widget file from template
     */
    public function createFiles()
    {
        // Copy template files
        foreach ($this->template as $tpl) {
            if(is_array($tpl)) {
                file_put_contents(
                    $this->getWidgetPath() . $tpl['out'],
                    $this->getTemplateContent($tpl['src'])
                );
            } else {
                file_put_contents(
                    $this->getWidgetPath() . $this->getWidgetName() . '.' . pathinfo($tpl, PATHINFO_EXTENSION),
                    $this->getTemplateContent($tpl)
                );
            }
        }

        // Build Language files
        foreach(scandir(WidgetConfig::getBasePath() . 'lang/') as $lang) {
            if($lang !== '.' && $lang !== '..') {

                $langDir = WidgetConfig::getBasePath() . 'lang/' . $lang . '/';

                if(is_dir(langDir)) {
                    mkdir(langDir, 0755);
                }

                file_put_contents(langDir . $this->getWidgetName() . '.php', $this->getTemplateContent('lang.php'));
            }
        }
    }


    public function writeConfig()
    {
        $this->configJson = json_decode(file_get_contents($this->getConfigFile()));

        $object = new Config();
        $object->name = $this->getWidgetName();
        $object->src = collect($this->template)->map(function ($tpl) use ($object) {
            if(is_array($tpl)) {
                return $object->name . '.' . pathinfo($tpl["out"], PATHINFO_EXTENSION);
            }
            return $object->name . '.' . pathinfo($tpl, PATHINFO_EXTENSION);
        });

        $this->configJson[] = $object;

        file_put_contents(
            $this->getConfigFile(),
            json_encode($this->configJson, JSON_PRETTY_PRINT)
        );
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


}
