<?php

namespace SvenH\PetFishCo\Constraints;

use SvenH\PetFishCo\ExpressionLanguage\ExpressionLanguageFactory;
use SvenH\PetFishCo\Managers\PropertyManager;
use SvenH\PetFishCo\Model\AquariumMutationInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InventoryRestrictionValidator extends ConstraintValidator
{
    /**
     * @var ExpressionLanguageFactory
     */
    protected $factory;

    /**
     * @var PropertyManager
     */
    protected $propertyManager;

    /**
     * InventoryRestrictionValidator constructor
     *
     * @param ExpressionLanguageFactory $factory
     * @param PropertyManager           $propertyManager
     */
    public function __construct(ExpressionLanguageFactory $factory, PropertyManager $propertyManager)
    {
        $this->factory         = $factory;
        $this->propertyManager = $propertyManager;
    }

    /**
     * @param AquariumMutationInterface $value
     * @param Constraint                $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $expressionLanguage = $this->factory::create();
        $context            = [ 'aquarium' => $value->getAquarium(), 'fish' => $value->getFish() ];

        $restrictions = $this->propertyManager->getAllProperties(
            $this->propertyManager->getTypeIdByName('Restriction')
        );

        foreach ($restrictions as $restriction) {
            $restriction = $expressionLanguage->evaluate($restriction);

            $violation = (bool) $expressionLanguage->evaluate($restriction['expression'], $context);

            if ($violation === true) {
                $this->context->buildViolation($constraint->message)->setParameter('%string%', $restriction['message'])->addViolation();
            }
        }
    }


}