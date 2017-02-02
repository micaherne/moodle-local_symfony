<?php

namespace local_symfony\validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class moodle_type_validator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        try {
            validate_param($value, $constraint->type);
        } catch (\invalid_parameter_exception $e) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('%string%', $value)
            ->setParameter('%type%', 'PARAM_' . strtoupper($constraint->type))
            ->addViolation();
        }
    }
}