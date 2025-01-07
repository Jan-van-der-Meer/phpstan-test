<?php
namespace Koya\Phpstantest\extension;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;

class TestDynamicMethodReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
	{
		return \Koya\Phpstantest\analyseObject\DynamicMehodReturn::class;
	}

	public function isMethodSupported(MethodReflection $methodReflection): bool
	{
		return $methodReflection->getName() === 'dynamicReturnMethod';
	}

	public function getTypeFromMethodCall(
		MethodReflection $methodReflection,
		MethodCall $methodCall,
		Scope $scope
	): ?Type
	{
		if (count($methodCall->getArgs()) !== 1) {
			return null;
		}
        
		$arg = $methodCall->getArgs()[0]->value;
        return $scope->getType($arg); 
	}
}
