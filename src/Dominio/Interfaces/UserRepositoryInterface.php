<?php 
declare(strict_types=1);

namespace Src\Dominio\Interfaces;
use src\Dominio\Entities\User;

interface UserRepositoryInterface
{
    public function getAll();
    public function getUserOfId(int $id): ?User;
    public function saveUser(User $user);
    public function editUser(User $user);
    public function deleteUser(int $id);
}
?>