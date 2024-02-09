<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator
    {name : Class (singular) for example User} {path : Class (singular) for example User Api} {table : Class (singular) for example users}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

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
        $name = $this->argument('name');
        $path = $this->argument('path');
        $dbname = $this->argument('table');

        $this->model($name, $dbname);
        $this->controller($name, $path, $dbname);

        $routes = "/*--------------------------------------------------------------------------------
            {$name} ROUTES  => START
        --------------------------------------------------------------------------------*/


        Route::prefix('admin/{$dbname}')->namespace('Admin')->group(function () {
            Route::middleware(['admin'])->group(function () {
                Route::get('/', '{$name}Controller@index')->name('admin.{$dbname}.index');
                Route::get('/create', '{$name}Controller@create')->name('admin.{$dbname}.create');
                Route::post('/', '{$name}Controller@store')->name('admin.{$dbname}.store');
                Route::get('/{id}/edit', '{$name}Controller@edit')->name('admin.{$dbname}.edit');
                Route::post('/{id}', '{$name}Controller@update')->name('admin.{$dbname}.update');
                Route::delete('/{id}', '{$name}Controller@destroy')->name('admin.{$dbname}.destroy');
            });
        });
        /*--------------------------------------------------------------------------------
            {$name} ROUTES  => END
        --------------------------------------------------------------------------------*/";

        \Illuminate\Support\Facades\File::append(base_path('routes/web.php'), $routes);

        return 'Success!';
    }

    protected function model($name, $tableName)
    {
        $attributes = Schema::getColumnListing($tableName);
        $fields = '';
        $rules = '';
        $i = 0;
        $count = count($attributes);
        foreach ($attributes as $attribute) {
            $i++;
            if ($attribute != 'id') {
                if ($i == $count) {
                    $fields .= "'{$attribute}'";
                } else {
                    $fields .= "'{$attribute}', ";
                }
                $type = Schema::getColumnType($tableName, $attribute);
                $rules .= "'{$attribute}' => '{$type}|nullable',\n";
            }
        }

        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{fillable}}',
                '{{table}}',
                '{{rules}}'
            ],
            [
                $name,
                $fields,
                $tableName,
                $rules
            ],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function controller($name, $path, $tableName)
    {
        $attributes = Schema::getColumnListing($tableName);
        $fields = '';
        $response = '';
        foreach ($attributes as $attribute) {
            $type = Schema::getColumnType($tableName, $attribute);
            $fields .= "* @bodyParam {$attribute} {$type} no-required {$attribute}\n";
            $response .= "*  \"{$attribute}\": \"{$type}\",\n";
        }

        if ($path == '/') {
            $path = "/Http/Controllers/{$name}Controller.php";
            $namespace = '';
        } else {
            $namespace = '\\' . str_replace('/', '\\', $path);
            $path = "/Http/Controllers/{$path}/{$name}Controller.php";
        }

        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{fields}}',
                '{{namespace}}',
                '{{response}}'
            ],
            [
                $name,
                $fields,
                $namespace,
                $response
            ],
            $this->getStub('Controller')

        );

        file_put_contents(app_path($path), $controllerTemplate);
    }

    protected function getDbName($name): string
    {
        $array = preg_split('/(?=[A-Z])/',$name);
        $db_name = '';
        foreach ($array as $i => $arr) {
            if ($i > 0) {
                if ($i != 1) {
                    $db_name .= '_';
                }
                $db_name .= strtolower($arr);
            }
        }

        return Str::plural($db_name);
    }
}
