<?php

namespace local_symfony\routing;

use Symfony\Component\Routing\Router;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Symfony\Component\HttpFoundation\Request;

/**
 * Router for moodle plugins.
 *
 * This looks for a routing config file at app/config/routing.yml in all
 * plugins and routes according to the routes given.
 *
 */
class moodle_router extends Router {

	protected $loader;

	public function __construct() {
		$locator = new FileLocator();
		$this->loader = new YamlFileLoader($locator);
		parent::__construct($this->loader, '');
	}

	public function getRouteCollection() {

		global $CFG;

		$routespath = 'app/config/routing.yml';
		$plugintypes = \core_component::get_plugin_types();
		$routedcomponents = array();
		foreach ($plugintypes as $plugintype => $typedir) {
			$plugins = \core_component::get_plugin_list_with_file($plugintype, $routespath);
			foreach ($plugins as $name => $path) {
				$routedcomponents[$plugintype . '_' . $name] = $path;
			}
		}

		$collectionbuilder = new RouteCollectionBuilder($this->loader);
		foreach ($routedcomponents as $component => $routeyamlpath) {
			list($plugintype, $pluginname) = \core_component::normalize_component($component);
			$collectionbuilder->import($path, str_replace($CFG->dirroot, '', \core_component::get_plugin_directory($plugintype, $pluginname)));
		}
		return $collectionbuilder->build();
	}

}