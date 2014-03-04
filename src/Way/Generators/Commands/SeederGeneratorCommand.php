<?php namespace Way\Generators\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class SeederGeneratorCommand extends GeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a database table seeder';

    /**
     * The path where the file will be created
     *
     * @return mixed
     */
    protected function getFileGenerationPath()
    {
        $tableName = ucwords($this->argument('tableName'));

        return $this->option('path') . "/{$tableName}TableSeeder.php";
    }

    /**
     * Fetch the template data
     *
     * @return array
     */
    protected function getTemplateData()
    {
        $tableName = ucwords($this->argument('tableName'));

        return [
            'CLASS' => "{$tableName}TableSeeder",
            'MODEL' => str_singular($tableName)
        ];
    }

    /**
     * Get path to template for generator
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return Config::get('generators::config.seed_template_path');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('tableName', InputArgument::REQUIRED, 'The name of the table to seed')
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['path', null, InputOption::VALUE_OPTIONAL, 'Where should the file be created?', app_path('database/seeds')]
        ];
    }

}
