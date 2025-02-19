<?php

declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): ?User;

    /**
     * @param string $username
     * @return User
     */
    public function findByUsername(string $username): ?User;

    /**
     * @param string $query
     * @param int $elems
     * @param int $page
     * @return UsersSearchResultsDTO
     */
    public function search(string $keyword, int $maxResults, int $page): UsersSearchResultsDTO;

    /**
     * @param User $user
     * @throws UserAlreadyExistsException
     */
    public function save(User $user): void;

    /**
     * @param User $user
     * @throws UserNotFoundException
     */
    public function update(User $user): void;

    /**
     * @param User $user
     * @throws UserNotFoundException
     */
    public function delete(User $user): void;
}
