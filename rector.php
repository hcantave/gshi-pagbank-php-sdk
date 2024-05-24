<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

return RectorConfig::configure() 
    ->withPaths([
        __DIR__ . '/public',
        __DIR__ . '/source',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets(php82: true)
    ->withImportNames(removeUnusedImports: true)
    ->withPreparedSets(deadCode: true, codeQuality: true, naming: true)
    ->withRules([
        AddVoidReturnTypeWhereNoReturnRector::class,
    ]);

    $rectorConfig->sets([
    SetList::DEAD_CODE,
    SetList::EARLY_RETURN,
    SetList::TYPE_DECLARATION,
    SetList::CODE_QUALITY,
    SetList::CODING_STYLE,
    LevelSetList::UP_TO_PHP_82
]);