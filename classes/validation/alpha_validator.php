<?php

namespace local_symfony\validation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class alpha_validator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value != clean_param($value, PARAM_ALPHA)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}