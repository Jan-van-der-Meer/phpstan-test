<?php 
namespace Medi\Line\Vega\Util;

class Level1
{
    public function testAction($flag) {
        if ($flag) {
            $possiblyUndifined = "test";
        }
        echo $possiblyUndifined;
    }

    public function knownMethod($test)
    {
        $instance = new MagicClass();
        $instance->undefined("test");
    }
}

/**
 * @method void defiend(String $param)
 */
class MagicClass
{
    public function __call($name, $arguments) {
        
        // do the work
    }
}

$instance = new MagicClass();
$instance->undefined("test");