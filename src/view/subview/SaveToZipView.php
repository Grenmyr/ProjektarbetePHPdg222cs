<?php
namespace src\view\subview;

/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-18
 * Time: 08:31
 */

class SaveToZipView {
    /**
     *@param InterpretModel[]
     *
     */
    private $phpFactory;

    private static $path = "phpfiles/";

    public function __construct($classes){
        $this->phpFactory = new PHPFactory();
        $this->CreatePHPFiles($classes);
    }

    public function CreatePHPFiles($classes){
        if(is_array($classes)){
            foreach ($classes as $value){

                $classContent = "<?php\n";

                $className = $value->GetClassName();
                $classContent .="".$this->phpFactory->GetClassNameSyntax($className)."\n";

                $relations = $value->GetRelations();
                if(count($relations)>0){
                    $requireonceString="";
                    $classContent .= "".$this->phpFactory->GetEmptyConstruct()."\n";
                    foreach ($relations  as $relation){
                        $classContent .= "".$this->phpFactory->GetRelationSyntax($relation)."\n";
                        $requireonceString .= $this->phpFactory->GetRequireOnce($relation)."\n";
                    }
                    $replace ="<?php\n";
                    $replace .= $requireonceString;
                    $classContent = preg_replace('/<\?php/',$replace,$classContent);

                    $classContent .= $this->phpFactory->GetEndBracket()."\n";
                }

                $variables = $value->GetVariables();
                foreach ($variables  as $functionObject){
                    $classContent .= "".$this->phpFactory->GetVariableSyntax($functionObject)."\n";
                }

                $functions = $value->GetFunctions();
                foreach ($functions  as $functionObject){
                    $classContent .= "".$this->phpFactory->GetFunctionSyntax($functionObject)."\n";
                }
                $classContent .="}";
                file_put_contents("".self::$path."".$className.".php","$classContent");
        }
        }
    }

   /* private function CreatePHPFiles($classes)
    {
        file_put_contents('test.txt','data');
        function file_force_contents($dir, $content){
            $parts = explode('/', $dir);
            $file = array_pop($parts);
            $dir = '';
            foreach($parts as $part)
                if(!is_dir($dir .= "/$part")) mkdir($dir);
            file_put_contents("$dir/$file", $content);
        }
        foreach($classes as $class){
            $className = $class->GetClassName();
            $variables = $class->GetVariables();
            $functions = $class->GetFunctions();
            $relations = $class->GetRelations();


        }
        var_dump($classes);
    }*/

} 