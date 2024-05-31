<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;
use Symfony\Component\VarDumper\Caster\ReflectionCaster;

class extractModelRelationToArray extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ex-model {model} {relation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->storeMethodsToConfigFile(
            $this->extractRelations(
                $this->argument('model'),
                $this->argument('relation')
            ),
            class_basename($this->argument('model'))
        );
    }

    private function extractRelations(string $model, string $relation)
    {
        // $methods = [
        //     'model_name' => [
        //         'method' => 'method_name',
        //         'relation' => 'relation_type'
        //     ]
        // ];
        $relations = [$relation];

        $reflector  = new \ReflectionClass($model);

        $methods = collect($reflector->getMethods())->filter(function ($method) use ($relations) {
            $returnType = $method->getReturnType();
            if ($returnType) {
                return in_array(class_basename($returnType->getName()), $relations);
            }
        });

        return $methods->toArray();
    }

    private function storeMethodsToConfigFile(array $methods, string $model)
    {
        // validate file if in config
        $methodsArr  = [];
        if (!file_exists(storage_path('app/model_methods.php'))) {
            // create file'
            $methodsArr[$model] = $methods;

            //  file_put_contents(storage_path('app'),'model_method.json' ) ;
            file_put_contents(storage_path('app/model_methods.json'), json_encode($methodsArr));

            return $methodsArr;
        }

        // get methods from storage

        $methodsFromStorage = json_decode(file_get_contents(storage_path('app/model_methods.json')), true);

        $methodsFromStorage[$model] = $methods;

        file_put_contents(storage_path('app/model_methods.json'), json_encode($methodsFromStorage));

        return $methodsFromStorage;
    }
}
