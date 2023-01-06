<?php

class Container
{
    private $services = [];

    public function __construct(array $services)
    {
        $this->services = $services;
    }

    public function get($serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            throw new \Exception("Service $serviceName not found");
        }

        return $this->services[$serviceName]();
    }
}
