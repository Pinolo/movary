<?php declare(strict_types=1);

namespace Movary\Application\Movie;

use Movary\AbstractList;

/**
 * @method Entity[] getIterator()
 * @psalm-suppress ImplementedReturnTypeMismatch
 */
class EntityList extends AbstractList
{
    public static function create() : self
    {
        return new self();
    }

    public static function createFromArray(array $data) : self
    {
        $list = new self();

        foreach ($data as $movie) {
            $list->add(Entity::createFromArray($movie));
        }

        return $list;
    }

    private function add(Entity $movie) : void
    {
        $this->data[] = $movie;
    }
}