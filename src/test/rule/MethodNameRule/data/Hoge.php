<?php
namespace Koya\Phpstantest\test\rule\MethodNameRule\data;

class Hoge
{
    /**
     * get始まりなのでOK
     */
    public function getTest() {}
    
    /**
     * post始まりなのでOK
     */
    public function postTest(){}
    
    /**
     * 始まりがgetでもpostでもないので始まりなのでNG
     */
    public function fetchTest(){}
}
