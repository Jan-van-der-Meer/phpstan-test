<?php

namespace Koya\Phpstantest\extension;

use Koya\Phpstantest\analyseObject\MethodExtension;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Type\MethodParameterOutTypeExtension;
use PHPStan\Type\IntegerType;
use PHPStan\Type\Type;
use PHPStan\Type\Constant\ConstantArrayType;
use PHPStan\Type\Constant\ConstantStringType;

class OriginalMethodExtension implements MethodParameterOutTypeExtension {

	public function isMethodSupported(MethodReflection $methodReflection, ParameterReflection $parameter): bool
	{
		return true
			// $methodReflection->getDeclaringClass()->getName() === MethodExtension::class
			// && $methodReflection->getName() === 'testAction'
			// && $parameter->getName() === 'data'
		;
	}

	public function getParameterOutTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, ParameterReflection $parameter, Scope $scope): ?Type
	{
		return new ConstantArrayType([
			new ConstantStringType('test'),
		], [
			new IntegerType(),
		]);
		return new IntegerType();
	}
}