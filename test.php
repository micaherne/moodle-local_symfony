<?php
use Symfony\Component\Validator\Validation;
use Doctrine\Common\Annotations\AnnotationRegistry;
use local_symfony\templating\moodle_engine;
use local_symfony\validator\moodle_type;

define('CLI_SCRIPT', 1);
require_once '../../config.php';
require_once 'vendor/autoload.php';

$PAGE->set_context(context_system::instance());

$engine = new moodle_engine();

class TestClass {

    /** @moodle_type(PARAM_URL) */
    public $url = 'http://localhost';

    /** @moodle_type(PARAM_INT) */
    public $int = 'three hundred and fifty';

    /** @moodle_type(PARAM_USERNAME) */
    public $username = 'fjksdl @@@ # ';

}

$test = new TestClass();

AnnotationRegistry::registerFile($CFG->dirroot . "/local/symfony/classes/validator/moodle_type.php");

$validator = Validation::createValidatorBuilder()
    ->enableAnnotationMapping()
    ->getValidator();

$violations = $validator->validate($test);

foreach ($violations as $violation) {
    echo html_writer::tag('p', $violation->getMessage());
}