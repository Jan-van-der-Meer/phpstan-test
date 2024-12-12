<?php
namespace Koya\Phpstantest\analyseObject;

use Koya\Phpstantest\extension\OriginalMethodExtension as ExtensionOriginalMethodExtension;

class OriginalMethodExtension
{
    /**
     * @param array{test2: string} $data
     */
    public function testAction(array $data): void
    {
        $a = $data["test"];
    }
}
