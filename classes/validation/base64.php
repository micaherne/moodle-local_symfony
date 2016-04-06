<?php

namespace local_symfony\validation;

use Symfony\Component\Validator\Constraint;

class base64 extends Constraint {
    public $message = 'The string "%string%" is not a valid PARAM_BASE64.';
    
    public function validatedBy() {
	    return get_class($this).'_validator';
	}
}