<?php

namespace HITcKit\Cms;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Prepare
{
    public static function postCreateProject(Event $event)
    {
        $dir = realpath('.');

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $path) {
            if ($path->isDir()) {
                rmdir((string)$path);
            } else {
                unlink((string)$path);
            }
        }
    }
}