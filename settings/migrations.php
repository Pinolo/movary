<?php declare(strict_types=1);

/** @var DI\Container $container */
$container = require(__DIR__ . '/../bootstrap.php');

$config = $container->get(Movary\ValueObject\Config::class);

$databaseMode = \Movary\Factory::getDatabaseMode($config);
if ($databaseMode !== 'sqlite' && $databaseMode !== 'mysql') {
    throw new \RuntimeException('Not supported database mode: ' . $databaseMode);
}

return [
    'table_storage' => [
	'table_name' => 'doctrine_migration_version',
	'version_column_name' => 'version',
	'version_column_length' => 191,
	'executed_at_column_name' => 'executed_at',
	'execution_time_column_name' => 'execution_time',
    ], 
    'migrations_paths' => [
        'Movary\DoctrineMigrations' => __DIR__ . '/../db/doctrine-migrations/' . $databaseMode,
    ],
    'all_or_nothing' => true,
    'transactional' => true,
    'check_database_platform' => true,
    'organize_migrations' => 'none',
    'connection' => null,
    'em' => null,
];
