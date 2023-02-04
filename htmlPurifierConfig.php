<?php
$config = HTMLPurifier_Config::createDefault();

$config->set('Cache.DefinitionImpl', null);
$config->set('HTML.AllowedElements', 'strong,em');
$config->set('HTML.AllowedAttributes', []);

$purifier = new HTMLPurifier($config);