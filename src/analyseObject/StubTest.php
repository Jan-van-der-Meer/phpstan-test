<?php
namespace Koya\Phpstantest\analyseObject;

use Koya\Phpstantest\thirdparty\ThirdParty;

class StubTest
{
    public function call(): string
    {
        $thirdParty = new ThirdParty();
        return $thirdParty->thirdPartyMethod(10);
    }
}