<?php

use function DI\autowire;
use csl\commands\RunCommand;
use csl\utils\BytesUtil;

return [
    'phpDi' => [
        //
        // PHP-DI configuration
        //
        RunCommand::class => autowire(RunCommand::class),
        BytesUtil::class => autowire(BytesUtil::class),
    ],
    'paths' => [
        'data' => __DIR__ . '/../data'
    ]
];