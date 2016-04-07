<?php

namespace local_symfony\annotations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class moodle_type_validator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ((string) $value != (string) clean_param($value, $constraint->type)) {

            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->setParameter('%type%', 'PARAM_' . strtoupper($constraint->type))
                ->addViolation();
        }
    }
}