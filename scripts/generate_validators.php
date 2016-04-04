<?php

define('CLI_SCRIPT', 1);
//define('ABORT_AFTER_CONFIG', 1); // PARAM_* constants not defined by then :(

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/mustache/src/Mustache/Autoloader.php');

// ensure directory exists
$target = $CFG->dirroot . '/local/symfony/classes/validation';
if (!file_exists($target)) {
    mkdir($target, null, true);
}

// Initialise templating engine
Mustache_Autoloader::register();
$loader = new Mustache_Loader_FilesystemLoader(__DIR__ . '/templates');
$mustache = new Mustache_Engine(array('loader' => $loader));

$constants = get_defined_constants(true);

$i = 0;
foreach ($constants['user'] as $constant => $value) {
    if (strpos($constant, 'PARAM_') === 0) {
        $context = array('name' => $value, 'paramconst' => $constant);

        $filename = $target . '/' . $value;
        $data = $mustache->render('validation/constraint', $context);
        file_put_contents($filename . '.php', $data);

        $filename .= '_validator';
        $data = $mustache->render('validation/constraintvalidator', $context);
                file_put_contents($filename . '.php', $data);
    }
}
