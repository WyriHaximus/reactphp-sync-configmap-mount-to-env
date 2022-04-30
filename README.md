# ReactPHP Sync Configmap Mount to environment

Monitors and syncs configmap mount into environment variables

![Continuous Integration](https://github.com/wyrihaximus/reactphp-sync-configmap-mount-to-env/workflows/Continuous%20Integration/badge.svg)
[![Latest Stable Version](https://poser.pugx.org/wyrihaximus/react-sync-configmap-mount-to-env/v/stable.png)](https://packagist.org/packages/wyrihaximus/react-sync-configmap-mount-to-env)
[![Total Downloads](https://poser.pugx.org/wyrihaximus/react-sync-configmap-mount-to-env/downloads.png)](https://packagist.org/packages/wyrihaximus/react-sync-configmap-mount-to-env/stats)
[![Type Coverage](https://shepherd.dev/github/WyriHaximus/reactphp-sync-configmap-mount-to-env/coverage.svg)](https://shepherd.dev/github/WyriHaximus/reactphp-sync-configmap-mount-to-env)
[![License](https://poser.pugx.org/wyrihaximus/react-sync-configmap-mount-to-env/license.png)](https://packagist.org/packages/wyrihaximus/react-sync-configmap-mount-to-env)

# Installation

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/react-sync-configmap-mount-to-env
```

# Usage

```php
use React\EventLoop\Loop;
use WyriHaximus\React\Env\ConfigMapMountSyncer\Syncer;
use function React\Async\await;
use function React\Promise\Timer\sleep;

getenv('Q_PRE_FETCH_COUNT'); // null
file_put_contents('/etc/mounted-confimap/Q_PRE_FETCH_COUNT', 5); // Just here to show the value in the file

$canceler = Syncer::sync('/etc/mounted-configmap');

Loop::addTimer(5, $canceler); // Cancels the syncer after five seconds
await(sleep(6))

getenv('Q_PRE_FETCH_COUNT'); // 5
```

# License

The MIT License (MIT)

Copyright (c) 2022 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
