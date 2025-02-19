<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\ActionError;
use App\Domain\User\User;
use App\Domain\User\UserAlreadyExistsException;
use App\Domain\User\UserInvalidTypeException;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class RegisterCustomerAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $newUserData = $this->getFormData();
        if(is_null($newUserData)) {
            $error = new ActionError(ActionError::BAD_REQUEST, 'Invalid request body.');
            return $this->respondWithData($error, 400);
        }

        $password = $newUserData['password'];
        if(!isset($password) || !is_string($password)) {
            $error = new ActionError(ActionError::BAD_REQUEST, 'Invalid password.');
            return $this->respondWithData($error, 400);
        }

        $firstName = $newUserData['firstName'];
        if(!isset($firstName) || !is_string($firstName)) {
            $error = new ActionError(ActionError::BAD_REQUEST, 'Invalid first name.');
            return $this->respondWithData($error, 400);
        }

        $surnames = $newUserData['surnames'];
        if(!isset($surnames) || !is_string($surnames)) {
            $error = new ActionError(ActionError::BAD_REQUEST, 'Invalid surnames.');
            return $this->respondWithData($error, 400);
        }

        $phoneNumber = $newUserData['phoneNumber'];
        if(!isset($phoneNumber) || !is_string($phoneNumber)) {
            $error = new ActionError(ActionError::BAD_REQUEST, 'Invalid phone number.');
            return $this->respondWithData($error, 400);
        }

        try {
            $user = new User(
                $phoneNumber,
                $firstName,
                $surnames,
                $phoneNumber,
                $password,
                User::USER_TYPE_CUSTOMER
            );
            $this->userRepository->save($user);
            return $this->respondWithData(null, 201);
        }
        catch(UserInvalidTypeException $e) {
            $error = new ActionError(ActionError::BAD_REQUEST, 'Invalid user type.');
            return $this->respondWithData($error, 400);
        }
        catch(UserAlreadyExistsException $e) {
            $error = new ActionError(ActionError::CONFLICT, 'An user with the same username or phone number already exists.');
            return $this->respondWithData($error, 409);
        }
        catch(Exception $e) {
            $this->logger->error($e->getMessage());
            $error = new ActionError(ActionError::SERVER_ERROR, 'Internal server error.');
            return $this->respondWithData($error, 500);
        }
    }
}
