<?php
use Symfony\Component\Validator\Validation;

require_once '../../config.php';
require_once 'vendor/autoload.php';

use local_symfony\annotations\moodle_type;
use Doctrine\Common\Annotations\AnnotationRegistry;

class TestClass {

    /** @moodle_type(PARAM_URL) */
    public $url = 'http://localhost';

    /** @moodle_type(PARAM_INT) */
    public $int = 'three hundred and fifty';

    /** @moodle_type(PARAM_USERNAME) */
    public $username = 'fjksdl @@@ # ';

}

$test = new TestClass();

AnnotationRegistry::registerFile($CFG->dirroot . "/local/symfony/classes/annotations/moodle_type.php");

$validator = Validation::createValidatorBuilder()
    ->enableAnnotationMapping()
    ->getValidator();

$violations = $validator->validate($test);

foreach ($violations as $violation) {
    echo html_writer::tag('p', $violation->getMessage());
}