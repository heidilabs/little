<?php
/**
 * ConfigFileLoader - Loads YAML config files
 */

namespace Little\Loader;

use Little\Exception\ResourceNotFoundException;
use Symfony\Component\Yaml\Yaml;

class ConfigFileLoader
{
    /**
     * @param string $configFile A path to a yaml config file
     * @return array The config matrix
     *
     * @throws ResourceNotFoundException
     */
    public function load($configFile)
    {
        if (!is_file($configFile)) {
            throw new ResourceNotFoundException(sprintf('The config file "%s" was not found.', $configFile));
        }

        return Yaml::parse(file_get_contents($configFile));
    }
}
