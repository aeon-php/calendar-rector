<?php

declare(strict_types=1);

use Aeon\Calendar\Rector\DateTimeImmutable\ClassDateTimePropertyToAeonDateTimeRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(ClassDateTimePropertyToAeonDateTimeRector::class);
};
