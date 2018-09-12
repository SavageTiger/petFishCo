<?php

namespace SvenH\PetFishCo\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ExpressionLanguageFactory
{
    /**
     * Create decorated expression language service
     *
     * @return ExpressionLanguage
     */
    public static function create(): ExpressionLanguage
    {
        $expressionLanguage = new ExpressionLanguage();
        $expressionLanguage->registerProvider(new FunctionProvider($expressionLanguage));

        return $expressionLanguage;
    }
}