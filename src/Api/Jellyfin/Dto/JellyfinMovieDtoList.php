<?php declare(strict_types=1);

namespace Movary\Api\Jellyfin\Dto;

use Movary\ValueObject\AbstractList;

/**
 * @method JellyfinMovieDto[] getIterator()
 * @psalm-suppress ImplementedReturnTypeMismatch
 */
class JellyfinMovieDtoList extends AbstractList
{
    public static function create(JellyfinMovieDto ...$movies) : self
    {
        $list = new self();

        foreach ($movies as $movie) {
            $list->add($movie);
        }

        return $list;
    }

    public static function createFromArray(array $data) : self
    {
        $list = self::create();

        foreach ($data as $movieData) {
            $list->add(JellyfinMovieDto::createFromArray($movieData));
        }

        return $list;
    }

    public function add(JellyfinMovieDto $movie) : void
    {
        $this->data[$movie->getJellyfinItemId()] = $movie;
    }

    public function getByItemId(string $itemId) : ?JellyfinMovieDto
    {
        return $this->data[$itemId] ?? null;
    }
}
