<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container9YVnH0V\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container9YVnH0V/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container9YVnH0V.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container9YVnH0V\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container9YVnH0V\App_KernelDevDebugContainer([
    'container.build_hash' => '9YVnH0V',
    'container.build_id' => '584a5524',
    'container.build_time' => 1588097281,
], __DIR__.\DIRECTORY_SEPARATOR.'Container9YVnH0V');
