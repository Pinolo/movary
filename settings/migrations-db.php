https://github.com/Pinolo/movary.git<?php declare(strict_types=1);

/** @var DI\Container $container */
$container = require(__DIR__ . '/../bootstrap.php');

$config = $container->get(Movary\ValueObject\Config::class);

$databaseMode = \Movary\Factory::getDatabaseMode($config);
if ($databaseMode === 'sqlite') {
    @TODO port sqlite databaseConfig to Doctrine Migrations
    $sqliteFile = pathinfo($config->getAsString('DATABASE_SQLITE'));
    $databaseConfig = [
        'adapter' => 'sqlite',
        'name' => $sqliteFile['dirname'] . '/' . $sqliteFile['filename'],
        'suffix' => $sqliteFile['extension'],
    ];
} elseif (\Movary\Factory::getDatabaseMode($config) === 'mysql') {
    $databaseConfig = [
        'driver' => 'pdo_mysql',
        'host' => $config->getAsString('DATABASE_MYSQL_HOST'),
        'port' => \Movary\Factory::getDatabaseMysqlPort($config),
        'dbname' => $config->getAsString('DATABASE_MYSQL_NAME'),
        'user' => $config->getAsString('DATABASE_MYSQL_USER'),
        'password' => $config->getAsString('DATABASE_MYSQL_PASSWORD'),
        'charset' => \Movary\Factory::getDatabaseMysqlCharset($config),
        'collation' => 'utf8_unicode_ci',
    ];
} else {
    throw new \RuntimeException('Not supported database mode: ' . $databaseMode);
}

return $databaseConfig;
