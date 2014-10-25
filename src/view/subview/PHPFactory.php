<?php
namespace src\view\subview;
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-18
 * Time: 09:37
 */

// Create php syntax for both SavetoZipView and GuestView.
class PHPFactory
{

    public function GetClassNameSyntax($className)
    {
        return "class $className {";
    }

    public function GetEmptyConstruct()
    {
        return "public function __construct(){";
    }

    public function GetEndBracket()
    {
        return "}";
    }

    public function GetRequireOnce($class)
    {
        return 'require_once(__DIR__."/' . $class . '.php");';
    }

    public function GetRelationSyntax($relationName)
    {
        $phpAsssociationSyntax = "";

        $lowCharRelationName = lcfirst($relationName);
        $phpAsssociationSyntax .= " $$lowCharRelationName =  new $relationName(); ";
        return $phpAsssociationSyntax;
    }

    //TODO Some refaktoring?
    /*
     * Refaktor so this class ask model for how classes are built up
     * and then populate the views acording to what user want?
     *
     * Atm SaveToZipView and GuestView do that and populate this functions. Which is not so good
     * i realised now just before deadline.
     * */
    public function GetVariableSyntax($variableObject)
    {
        $phpVariableSyntax = "";
        $private = $variableObject->GetPrivate();
        $name = $variableObject->GetName();
        if ($private) {
            $phpVariableSyntax .= "private $$name;";
        } else {
            $phpVariableSyntax .= "public $$name;";
        }
        return $phpVariableSyntax;
    }

    public function GetFunctionSyntax($functionObject)
    {
        $phpVariableSyntax = "";
        $private = $functionObject->GetPrivate();
        $name = $functionObject->GetName();
        if ($private) {
            $phpVariableSyntax .= "private function $name (){}";
        } else {
            $phpVariableSyntax .= "public function $name (){}";
        }
        return $phpVariableSyntax;
    }

} 