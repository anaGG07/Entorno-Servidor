<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPF9nOg1\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPF9nOg1/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPF9nOg1.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPF9nOg1\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerPF9nOg1\App_KernelDevDebugContainer([
    'container.build_hash' => 'PF9nOg1',
    'container.build_id' => 'e628541c',
    'container.build_time' => 1736765583,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPF9nOg1');
