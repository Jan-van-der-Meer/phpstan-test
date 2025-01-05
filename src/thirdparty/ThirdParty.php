<?php
namespace Koya\Phpstantest\thirdparty;

class ThirdParty
{
    /**
     * @param int $intArg
     * @return int
     */
    public function thirdPartyMethod($intArg)
    {
        return (string)$intArg;
    }
}
