<?php

namespace App\Repositories\Account;

interface AccountRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function login(array $credentials);
    public function logout();
}
