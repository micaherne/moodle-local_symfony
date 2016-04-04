<?php
use Symfony\Component\Validator\Validation;

require_once '../../config.php';
require_once 'vendor/autoload.php';

class TestClass {

    public $url = 'http://localhost';
    public $username = 'fjksdl @@@ # ';

}

$test = new TestClass();

$validator = Validation::createValidatorBuilder()
    ->addYamlMapping(__DIR__ . '/test_mappings.yml')
    ->getValidator();

$violations = $validator->validate($test);

print_r($violations);