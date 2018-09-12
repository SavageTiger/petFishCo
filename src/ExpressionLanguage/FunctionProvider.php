<?php

namespace SvenH\PetFishCo\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class FunctionProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @var ExpressionLanguage
     */
    protected $expressionLanguage;

    public function __construct(ExpressionLanguage $expressionLanguage)
    {
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new ExpressionFunction(
                'evaluateCollection', function () {  return null; },
                function (array $values, $collection, $expression) {
                    return $this->evaluateCollection($collection, $expression);
                }
            )
        ];
    }


    public function evaluateCollection(array $collection, string $expression)
    {
        foreach ($collection as $item) {
            $context = [ 'item' => $item ];

            if ($this->expressionLanguage->evaluate($expression, $context)) {
                return true;
            }
        }

        return false;
    }
}