<?php

declare(strict_types=1);

namespace Koya\Phpstantest\rule;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class MethodNameRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Stmt\ClassMethod::class;
    }

    /**
     * @param Node\Stmt\ClassMethod $node
     * @param Scope $scope
     * @return string[]
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $className = $scope->getClassReflection()?->getName();

        // 対象クラスを A のみに制限
        // NOTE: $classNameはnamespaceもついてくるのでstr_ends_withで比較
        if (!str_ends_with($className, '\\Hoge')) {
            return [];
        }

        $methodName = $node->name->toString();

        // 'get' または 'post' で始まっているかをチェック
        if (!preg_match('/^(get|post)/', $methodName)) {
            return [sprintf(
                'メソッドの名前はgetかpostで始めてください！ %s::%s',
                $className,
                $methodName
            )];
        }

        return [];
    }
}
