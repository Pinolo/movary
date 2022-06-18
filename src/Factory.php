<?php declare(strict_types=1);

namespace Movary;

use Doctrine\DBAL;
use GuzzleHttp;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Movary\Api\Tmdb;
use Movary\Api\Trakt;
use Movary\Api\Trakt\Cache\User\Movie\Watched;
use Movary\Application\Movie;
use Movary\Application\Service\Tmdb\SyncMovie;
use Movary\Application\SessionService;
use Movary\HttpController\PlexController;
use Movary\ValueObject\Config;
use Movary\ValueObject\Http\Request;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use Twig;

class Factory
{
    public static function createConfig() : Config
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        return Config::createFromEnv();
    }

    public static function createCurrentHttpRequest() : Request
    {
        return Request::createFromGlobals();
    }

    public static function createDbConnection(Config $config) : DBAL\Connection
    {
        return DBAL\DriverManager::getConnection(
            [
                'charset' => $config->getAsString('DATABASE_CHARSET'),
                'dbname' => $config->getAsString('DATABASE_NAME'),
                'port' => $config->getAsInt('DATABASE_PORT'),
                'user' => $config->getAsString('DATABASE_USER'),
                'password' => $config->getAsString('DATABASE_PASSWORD'),
                'host' => $config->getAsString('DATABASE_HOST'),
                'driver' => $config->getAsString('DATABASE_DRIVER'),
            ]
        );
    }

    public static function createFileLogger(Config $config) : LoggerInterface
    {
        $formatter = new LineFormatter(LineFormatter::SIMPLE_FORMAT, LineFormatter::SIMPLE_DATE);
        $formatter->includeStacktraces(true);

        $handler = new StreamHandler(
            __DIR__ . '/../' . $config->getAsString('LOG_FILE'),
            $config->getAsString('LOG_LEVEL')
        );
        $handler->setFormatter($formatter);

        $logger = new Logger('file');
        $logger->pushHandler($handler);

        return $logger;
    }

    public static function createHttpClient() : ClientInterface
    {
        return new GuzzleHttp\Client();
    }

    public static function createTmdbApiClient(ContainerInterface $container, Config $config) : Tmdb\Client
    {
        return new Tmdb\Client(
            $container->get(ClientInterface::class),
            $config->getAsString('TMDB_API_KEY')
        );
    }

    public static function createTraktApi(ContainerInterface $container, Config $config) : Trakt\Api
    {
        return new Trakt\Api(
            $container->get(Trakt\Client::class),
            $config->getAsString('TRAKT_USERNAME'),
            $container->get(Watched\Service::class),
        );
    }

    public static function createTraktApiClient(ContainerInterface $container, Config $config) : Trakt\Client
    {
        return new Trakt\Client(
            $container->get(ClientInterface::class),
            $config->getAsString('TRAKT_CLIENT_ID')
        );
    }

    public static function createTwigEnvironment(ContainerInterface $container) : Twig\Environment
    {
        $twig = new Twig\Environment($container->get(Twig\Loader\LoaderInterface::class));

        $twig->addGlobal('loggedIn', $container->get(SessionService::class)->isCurrentUserLoggedIn());

        return $twig;
    }

    public static function createTwigFilesystemLoader() : Twig\Loader\FilesystemLoader
    {
        return new Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
    }

    public function createPlexController(ContainerInterface $container, Config $config) : PlexController
    {
        return new PlexController(
            $container->get(LoggerInterface::class),
            $container->get(Movie\Api::class),
            $container->get(SyncMovie::class),
            new \DateTimeZone($config->getAsString('TIMEZONE'))
        );
    }
}
