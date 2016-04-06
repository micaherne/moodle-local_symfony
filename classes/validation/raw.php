<?php

namespace local_symfony\validation;

use Symfony\Component\Validator\Constraint;

class raw extends Constraint {
    public $message = 'The string "%string%" is not a valid PARAM_RAW.';
    
    public function validatedBy() {
	    return get_class($this).'_validator';
	}
}