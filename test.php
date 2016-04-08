<?php
use Symfony\Component\Validator\Validation;
use local_symfony\templating\moodle_engine;

require_once '../../config.php';
require_once 'vendor/autoload.php';

$PAGE->set_context(context_system::instance());

$engine = new moodle_engine();
var_dump($engine->supports('mod_forum/forum_post_email_htmlemail_body'));
var_dump($engine->supports('test.twig.html'));
exit;

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