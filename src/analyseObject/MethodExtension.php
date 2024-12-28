<?php
namespace Koya\Phpstantest\analyseObject;

class MethodExtension
{
    /**
     * @phpstan-param TestKoya<''> $data
     */
    public function testAction(array $data): void
    {
        \PHPStan\dumpType($data);
    }
}
