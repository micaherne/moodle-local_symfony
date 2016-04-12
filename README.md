# moodle-local_symfony

A proof-of-concept plugin to enable plugin authors to use components of the Symfony framework.

## Routing

local\_symfony\routing\moodle\_router is an implementation of a Symfony router which looks for a config file in each plugin at app/config/routing.yml and returns the route matching the request.

This can be used to map the URL space under the plugin's root to Symfony controllers.

## Templating

local\_symfony\templating\moodle\_engine is a Symfony template engine which simply renders the named Moodle template.

It can be used to render the view in a Symfony controller.

## Validator

local\_symfony\validator\moodle\_type is an annotation which enables plugin authors to annotate class properties with their corresponding Moodle type (i.e. PARAM_* constant).

Classes with annotated properties can then be validated using the normal Symfony validator mechanisms.

(Technical note: the validation is done by comparing the cleaned parameter with its original value, both cast to strings, so may not be completely accurate for all types.) 
