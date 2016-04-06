<?php

namespace local_symfony\validation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class host_validator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value != clean_param($value, PARAM_HOST)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}