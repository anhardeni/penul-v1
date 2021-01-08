<?php
namespace app\reports;

//require(dirname(__FILE__)."../../../vendor/koolphp/koolreport/autoload.php");

//require_once "koolreport/autoload.php";

require_once "../vendor/koolreport/core/autoload.php";

class MyReport extends \koolreport\KoolReport
{   
    use \koolreport\clients\Bootstrap;
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\FontAwesome;
    use \koolreport\clients\jQuery;
    use \koolreport\yii2\Friendship;


    
    function setup()
    {
        $this->src("default")
        ->query("SELECT * FROM dsab")
        ->pipe($this->dataStore("dsab_list"));
    }    
}