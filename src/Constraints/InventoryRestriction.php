<?php

namespace SvenH\PetFishCo\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class InventoryRestriction extends Constraint
{
    public $message = '"%string%"';

    public function validatedBy()
    {
        return 'inventory_restriction';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}