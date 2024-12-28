<?php
namespace Koya\Phpstantest\test\rule\MethodNameRule;

use PHPStan\Testing\RuleTestCase;
use Koya\Phpstantest\rule\MethodNameRule;

class MethodNameRuleTest extends RuleTestCase
{
    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new MethodNameRule();
    }

    public function test_メソッド名はpostかgetから始まってないといけない(): void
    {
        $this->analyse([__DIR__ . '/data/Hoge.php'], [
            ['メソッドの名前はgetかpostで始めてください！ Koya\Phpstantest\test\rule\MethodNameRule\data\Hoge::fetchTest', 19],
        ]);
    }
}