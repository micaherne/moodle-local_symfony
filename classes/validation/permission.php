<?php

namespace local_symfony\validation;

use Symfony\Component\Validator\Constraint;

class permission extends Constraint {
    public $message = 'The string "%string%" is not a valid PARAM_PERMISSION.';
    
    public function validatedBy() {
	    return get_class($this).'_validator';
	}
}