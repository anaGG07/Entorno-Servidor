<?php

namespace ContainerPF9nOg1;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_VarDumper_Command_ServerDump_LazyService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.var_dumper.command.server_dump.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'Command.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'LazyCommand.php';

        return $container->privates['.var_dumper.command.server_dump.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('server:dump', [], 'Start a dump server that collects and displays dumps in a single place', false, #[\Closure(name: 'var_dumper.command.server_dump', class: 'Symfony\\Component\\VarDumper\\Command\\ServerDumpCommand')] fn (): \Symfony\Component\VarDumper\Command\ServerDumpCommand => ($container->privates['var_dumper.command.server_dump'] ?? $container->load('getVarDumper_Command_ServerDumpService')));
    }
}
