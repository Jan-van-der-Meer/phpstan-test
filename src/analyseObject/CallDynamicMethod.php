<?php
namespace Koya\Phpstantest\analyseObject;

use DateTime;

class CallDynamicMethod
{

    function classDynamicMethod(int $arg): void
    {
        $dynamicMethodClass = new DynamicMehodReturn();
        $response1 = $dynamicMethodClass->dynamicReturnMethod($arg);
        \PHPStan\dumpType($response1);
        $response2 = $dynamicMethodClass->dynamicReturnMethod("test");
        \PHPStan\dumpType($response2);
        $response3 = $dynamicMethodClass->dynamicReturnMethod(new DateTime());
        \PHPStan\dumpType($response3);
    }
}
