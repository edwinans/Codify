<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container8a4ouLK\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container8a4ouLK/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container8a4ouLK.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container8a4ouLK\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container8a4ouLK\App_KernelDevDebugContainer([
    'container.build_hash' => '8a4ouLK',
    'container.build_id' => '85d1a554',
    'container.build_time' => 1588349065,
], __DIR__.\DIRECTORY_SEPARATOR.'Container8a4ouLK');
