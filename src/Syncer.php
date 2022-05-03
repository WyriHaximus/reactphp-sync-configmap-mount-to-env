<?php

declare(strict_types=1);

namespace WyriHaximus\React\Env\ConfigMapMountSyncer;

use React\EventLoop\Loop;
use React\Filesystem\Factory;
use React\Filesystem\Node\DirectoryInterface;
use React\Filesystem\Node\FileInterface;
use React\Filesystem\Node\NodeInterface;

use function React\Async\async;
use function React\Async\await;
use function Safe\putenv;

final class Syncer
{
    private const CHECK_INTERVAL = 1;

    public static function sync(string $path): callable
    {
        $timer =         Loop::addPeriodicTimer(self::CHECK_INTERVAL, self::scan($path));

        return static fn () => Loop::cancelTimer($timer);
    }

    private static function scan(string $path): callable
    {
        $filesystem = Factory::create();

        return async(static function () use ($path, $filesystem): void {
            /**
             * @psalm-suppress TooManyTemplateParams
             */
            $directory = await($filesystem->detect($path));
            if (! ($directory instanceof DirectoryInterface)) {
                return; // TO-DO: Should Throw!
            }

            /**
             * @psalm-suppress TooManyTemplateParams
             * @var iterable<NodeInterface>
             */
            $nodes = await($directory->ls());
            foreach ($nodes as $node) {
                if (! ($node instanceof FileInterface)) {
                    continue;
                }

                /**
                 * @psalm-suppress MixedOperand
                 * @psalm-suppress TooManyTemplateParams
                 */
                putenv($node->name() . '=' . await($node->getContents()));
            }
        });
    }
}
