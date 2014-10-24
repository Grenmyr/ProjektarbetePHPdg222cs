<?php
namespace src\view\subview;

use ZipArchive;

/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-18
 * Time: 08:31
 */
class SaveToZipView
{
    /**
     * @param InterpretModel []
     *
     */
    private $phpFactory;

    private static $path = "phpfiles/";

    public function __construct($classes)
    {
        $this->phpFactory = new PHPFactory();
        $this->CreatePHPFiles($classes);
    }

    //Create files, populate with php code, then zip then *.php files.
    //lastly delete old php files and redirect to zip for download
    public function CreatePHPFiles($classes)
    {
        if (!file_exists(self::$path)) {
            mkdir(self::$path, 0777, true);
        }

        $zip = new ZipArchive();
        $name = "/" . rand() . ".zip";
        $zip->open(realpath(self::$path) . $name, ZipArchive::CREATE);

        if (is_array($classes)) {
            foreach ($classes as $value) {

                $classContent = "<?php\n";

                $className = $value->GetClassName();
                $classContent .= "" . $this->phpFactory->GetClassNameSyntax($className) . "\n";

                $relations = $value->GetRelations();
                if (count($relations) > 0) {
                    $requireonceString = "";
                    $classContent .= "" . $this->phpFactory->GetEmptyConstruct() . "\n";
                    foreach ($relations as $relation) {
                        $classContent .= "" . $this->phpFactory->GetRelationSyntax($relation) . "\n";
                        $requireonceString .= $this->phpFactory->GetRequireOnce($relation) . "\n";
                    }
                    $replace = "<?php\n";
                    $replace .= $requireonceString;
                    $classContent = preg_replace('/<\?php/', $replace, $classContent);

                    $classContent .= $this->phpFactory->GetEndBracket() . "\n";
                }

                $variables = $value->GetVariables();
                foreach ($variables as $functionObject) {
                    $classContent .= "" . $this->phpFactory->GetVariableSyntax($functionObject) . "\n";
                }

                $functions = $value->GetFunctions();
                foreach ($functions as $functionObject) {
                    $classContent .= "" . $this->phpFactory->GetFunctionSyntax($functionObject) . "\n";
                }
                $classContent .= "}";

                $zip->addFromString($className . ".php", $classContent);
            }
        }
        $zip->close();
        header("Location: " . self::$path . $name . "");
    }
} 