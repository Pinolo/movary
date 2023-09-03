<?php declare(strict_types=1);

namespace Movary\HttpController\Middleware;

use Movary\Domain\User\UserApi;
use Movary\ValueObject\Http\Response;

class DoesNotHaveUsers
{
    public function __construct(
        private readonly UserApi $userApi
    ) {}

    public function main() : ?Response
    {
        if ($this->userApi->hasUsers() === false) {
            return Response::createSeeOther('/create-user');
        }
        return null;
    }
}