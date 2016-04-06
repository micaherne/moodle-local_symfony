<?php

namespace local_symfony\validation;

use Symfony\Component\Validator\Constraint;

class alphanum extends Constraint {
    public $message = 'The string "%string%" is not a valid PARAM_ALPHANUM.';
    
    public function validatedBy() {
	    return get_class($this).'_validator';
	}
}