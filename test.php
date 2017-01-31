<?php
use local_symfony\form\moodle_renderer_engine;
use local_symfony\templating\moodle_engine;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

require_once '../../config.php';
require_once 'vendor/autoload.php';

$PAGE->set_context(context_system::instance());

$engine = new moodle_engine();

$factorybuilder = new FormFactoryBuilder();
$factory = $factorybuilder->addExtension(new CoreExtension())
    ->getFormFactory();

$form = $factory->createBuilder()
    ->add('textbim', TextareaType::class)
    ->getForm();

$view = $form->createView();

$rendererengine = new moodle_renderer_engine();
$renderer = new FormRenderer($rendererengine);
echo $renderer->renderBlock($view, 'form');
exit;

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