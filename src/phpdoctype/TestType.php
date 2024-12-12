<?php declare(strict_types = 1);

namespace Koya\Phpstantest\phpdoctype;

use PHPStan\Analyser\NameScope;
use PHPStan\PhpDoc\TypeNodeResolverExtension;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\Type\Constant\ConstantArrayTypeBuilder;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

class TestType implements TypeNodeResolverExtension
{

    public function resolve(TypeNode $typeNode, NameScope $nameScope): ?Type
    {

		if (!$typeNode instanceof GenericTypeNode) {
			// returning null means this extension is not interested in this node
			return null;
		}
		$typeName = $typeNode->type;
		if ($typeName->name !== 'TestKoya') {
			return null;
		}

        $newTypeBuilder = ConstantArrayTypeBuilder::createEmpty();
        $newTypeBuilder->setOffsetValueType( 
            new ConstantStringType("key"),
            new StringType()
        );
        $newTypes[] = $newTypeBuilder->getArray();
        return TypeCombinator::union(...$newTypes);
    }
}