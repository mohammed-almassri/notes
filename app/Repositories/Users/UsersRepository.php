<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\BaseRepository;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
