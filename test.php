<?php
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

require_once '../../config.php';
require_once 'vendor/autoload.php';

class YerMaw {

    public $url = 'http://localhost';

}

$yermaw = new YerMaw();

$validator = Validation::createValidatorBuilder()
    ->addYamlMapping(__DIR__ . '/test_mappings.yml')
    ->getValidator();

$violations = $validator->validate($yermaw);

print_r($violations);