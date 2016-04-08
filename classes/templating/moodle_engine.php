<?php

namespace local_symfony\templating;

use Symfony\Component\Templating\EngineInterface;
use core\output\mustache_template_finder;

class moodle_engine implements EngineInterface {


    public function render($name, array $parameters = array()) {
        global $PAGE;
        $component = $this->get_template_component($name);
        $renderer = $PAGE->get_renderer($component);
        return $renderer->render_from_template($name, $parameters);
    }

    public function exists($name) {
        try {
            mustache_template_finder::get_template_filepath($name);
            return true;
        } catch (\moodle_exception $e) {
            return false;
        }
    }

    public function supports($name) {
        if (count(explode('/', $name, 2)) !== 2) {
            return false;
        }
        $component = $this->get_template_component($name);
        return !is_null(\core_component::get_component_directory($component));
    }

    protected function get_template_component($name) {
        list($component) = explode('/', $name, 2);
        $component = clean_param($component, PARAM_COMPONENT);
        return \core_component::normalize_componentname($component);
    }

}