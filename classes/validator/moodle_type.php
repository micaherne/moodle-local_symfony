<?php

namespace local_symfony\validator;

use Symfony\Component\Validator\Constraint;

/**
 * Define the Moodle PARAM_* type of a property
 * @Annotation
 * @Target({"PROPERTY"})
 */
class moodle_type extends Constraint {

    public $type;

    public $message = 'The string "%string%" is not a valid %type%.';

    public function __construct($options) {
        $this->type = $options['value'];
    }

    function validatedBy() {
        return get_class($this).'_validator';
    }

}