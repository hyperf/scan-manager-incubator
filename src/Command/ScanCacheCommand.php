<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\ScanManager\Command;

use Hyperf\Command\Command;
use Hyperf\Utils\Filesystem\Filesystem;

class ScanCacheCommand extends Command
{
    public function __construct()
    {
        parent::__construct('scan:cache');
    }

    public function handle()
    {
        $filesystem = new Filesystem();
        $path = BASE_PATH . '/runtime/container/scan.cache';
        if (! $filesystem->exists($path)) {
            throw new \InvalidArgumentException('Please don\'t rewrite the path of scan.cache.');
        }

        [$data, $proxies] = unserialize($filesystem->get($path));
        $result = [];
        foreach ($proxies as $className => $filePath) {
            $result[$className] = str_replace(BASE_PATH . '/', '', $filePath);
        }

        $filesystem->put($path, serialize([$data, $result]));

        $this->output->writeln('Set scan cache successful.');
    }
}
