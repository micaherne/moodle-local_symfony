<?php

namespace local_symfony;

use Doctrine\Common\Annotations\AnnotationRegistry;

class main {

    private static $validation_initialised = false;

    public static function init_validation() {
        global $CFG;

        if (self::$validation_initialised) {
            return;
        }

        require_once($CFG->dirroot . '/local/symfony/vendor/autoload.php');

        AnnotationRegistry::registerFile($CFG->dirroot . "/local/symfony/classes/validator/moodle_type.php");

        self::$validation_initialised = true;
    }

}