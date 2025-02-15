<?php

namespace Be\F\Property;

use Be\F\Runtime\RuntimeException;
use Be\F\Runtime\RuntimeFactory;


/**
 * Property 工厂
 */
abstract class PropertyFactory
{

    private static $cache = [];

    /**
     * 获取一个属性（单例）
     *
     * @param string $name 名称
     * @return Driver
     * @throws RuntimeException
     */
    public static function getInstance($name)
    {
        if (isset(self::$cache[$name])) return self::$cache[$name];

        $frameworkName = RuntimeFactory::getInstance()->getFrameworkName();
        $parts = explode('.', $name);
        $class = 'Be\\' . $frameworkName . '\\' . implode('\\', $parts) . '\\Property';
        if (!class_exists($class)) throw new RuntimeException('Property ' . $name . ' doesn\'t exist!');
        $instance = new $class();

        self::$cache[$name] = $instance;
        return self::$cache[$name];
    }

}
