<?php

define('CLI_SCRIPT', 1);
//define('ABORT_AFTER_CONFIG', 1); // PARAM_* constants not defined by then :(

require_once(__DIR__ . '/../../../config.php');

// ensure directory exists
$target = $CFG->dirroot . '/local/symfony/classes/validation';
if (!file_exists($target)) {
    mkdir($target, null, true);
}

$constants = get_defined_constants(true);

$i = 0;
foreach ($constants['user'] as $constant => $value) {
    if (strpos($constant, 'PARAM_') === 0) {
        $filename = $target . '/' . $value;
        $data = "<?php namespace local_symfony\\validation;
            class $value extends \\Symfony\\Component\\Validator\\Constraint {
        public function validatedBy() {
            return get_class(\$this).'_validator';
        }}";
        file_put_contents($filename . '.php', $data);

        $filename .= '_validator';
        $data = "<?php namespace local_symfony\\validation;
                class {$value}_validator extends \\Symfony\\Component\\Validator\\ConstraintValidator {
        public function validate(\$value, \\Symfony\\Component\\Validator\\Constraint \$constraint) {
            if (\$value != clean_param(\$value, $constant)) {
                \$this->context->buildViolation('%string% is not a valid $constant')
                    ->setParameter('%string%', \$value)
                    ->addViolation();
            }
        }
        }";
                file_put_contents($filename . '.php', $data);
    }
}
