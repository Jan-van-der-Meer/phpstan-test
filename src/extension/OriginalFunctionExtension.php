<?php

namespace Koya\Phpstantest\extension;

use Koya\Phpstantest\analyseObject\FunctionExtension;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Type\FunctionParameterOutTypeExtension;
use PHPStan\Type\IntegerType;
use PHPStan\Type\Type;
use PHPStan\Type\Constant\ConstantArrayType;
use PHPStan\Type\Constant\ConstantStringType;

class OriginalFunctionExtension implements FunctionParameterOutTypeExtension {

	public function isFunctionSupported(FunctionReflection $functionReflection, ParameterReflection $parameter): bool
	{
		// return $functionReflection->getName() === 'ParameterOutTests\callWithOut' && $parameter->getName() === 'outParam';
		return true;
	}

	public function getParameterOutTypeFromFunctionCall(FunctionReflection $functionReflection, FuncCall $funcCall, ParameterReflection $parameter, Scope $scope): ?Type
	{
		return new StringType();
	}
}