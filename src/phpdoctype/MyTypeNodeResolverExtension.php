<?php declare(strict_types = 1);

namespace Koya\Phpstantest\phpdoctype;

use PHPStan\Analyser\NameScope;
use PHPStan\PhpDoc\TypeNodeResolver;
use PHPStan\PhpDoc\TypeNodeResolverAwareExtension;
use PHPStan\PhpDoc\TypeNodeResolverExtension;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\Type\Constant\ConstantArrayTypeBuilder;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\Type;
use PHPStan\Type\StringType;
use PHPStan\Type\TypeCombinator;

class MyTypeNodeResolverExtension implements TypeNodeResolverExtension
{

	// private TypeNodeResolver $typeNodeResolver;

	// public function setTypeNodeResolver(TypeNodeResolver $typeNodeResolver): void
	// {
	// 	$this->typeNodeResolver = $typeNodeResolver;
	// }

	public function resolve(TypeNode $typeNode, NameScope $nameScope): ?Type
	{
        // if (!$typeNode instanceof GenericTypeNode) {
		// 	// returning null means this extension is not interested in this node
		// 	return null;
		// }

		$typeName = $typeNode->type;
		if ($typeName->name !== 'Pick') {
			return null;
		}
		
        $newTypeBuilder = ConstantArrayTypeBuilder::createEmpty();
        $newTypeBuilder->setOffsetValueType( 
            new ConstantStringType("key"),
            new StringType()
        );

        $newTypes[] = $newTypeBuilder->getArray();
        return TypeCombinator::union(...$newTypes);

		$arguments = $typeNode->genericTypes;
		if (count($arguments) !== 2) {
			return null;
		}

		$arrayType = $this->typeNodeResolver->resolve($arguments[0], $nameScope);
		$keysType = $this->typeNodeResolver->resolve($arguments[1], $nameScope);

		$constantArrays = $arrayType->getConstantArrays();
		if (count($constantArrays) === 0) {
			return null;
		}

		$newTypes = [];
		foreach ($constantArrays as $constantArray) {
			$newTypeBuilder = ConstantArrayTypeBuilder::createEmpty();
			foreach ($constantArray->getKeyTypes() as $i => $keyType) {
				if (!$keysType->isSuperTypeOf($keyType)->yes()) {
					// eliminate keys that aren't in the Pick type
					continue;
				}

				$valueType = $constantArray->getValueTypes()[$i];
				$newTypeBuilder->setOffsetValueType(
					$keyType,
					$valueType,
					$constantArray->isOptionalKey($i),
				);
			}

			$newTypes[] = $newTypeBuilder->getArray();
		}

		return TypeCombinator::union(...$newTypes);
	}

}