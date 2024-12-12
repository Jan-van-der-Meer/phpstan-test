<?php
namespace Koya\Phpstantest\analyseObject;


class Foo
{

    /**
     * @param Pick<''> $personalDetails
     */
    public function doFoo(array $personalDetails): void
    {
        \PHPStan\dumpType($personalDetails); // array{name: string, surname: string}
    }

}