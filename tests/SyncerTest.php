<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\React\Env\ConfigMapMountSyncer;

use React\EventLoop\Loop;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use WyriHaximus\React\Env\ConfigMapMountSyncer\Syncer;

use function getenv;

use const DIRECTORY_SEPARATOR;

final class SyncerTest extends AsyncTestCase
{
    /**
     * @test
     */
    public function sync(): void
    {
        self::assertFalse(getenv('Q_PRE_FETCH_COUNT'));

        $canceler = Syncer::sync(__DIR__ . DIRECTORY_SEPARATOR . 'mounted-configmap');

        Loop::addTimer(5, $canceler);
        Loop::run();

        self::assertSame('5', getenv('Q_PRE_FETCH_COUNT'));
    }
}
