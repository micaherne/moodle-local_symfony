<?php

use local_symfony\main;
use Symfony\Component\Validator\Validation;
use local_symfony\validator\moodle_type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class local_symfony_validator_testcase extends \advanced_testcase {

    /** @var ValidatorInterface */
    private $validator;

    protected function setUp() {
        main::init_validation();
        $this->validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
    }

    public function testOne() {
        $obj1 = new local_symfony_validator_testcase_class1();
        $obj1->username = 'abc123';
        $obj1->url = 'https://www.google.com';

        /** @var Symfony\Component\Validator\ConstraintViolationList */
        $result = $this->validator->validate($obj1);
        $this->assertEmpty($result);

        $obj1->username = '\\\\:fjksdl @@@ # ';
        $result = $this->validator->validate($obj1);
        $this->assertNotEmpty($result);

    }

}

class local_symfony_validator_testcase_class1 {

    /** @moodle_type(PARAM_USERNAME) */
    public $username;

    /** @moodle_type(PARAM_URL) */
    public $url;

}