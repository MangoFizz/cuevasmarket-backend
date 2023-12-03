<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class ViewUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        $user = $this->userRepository->findById($userId);
        if(!$user) {
            throw new UserNotFoundException();
        }
        return $this->respondWithData($user);
    }
}
