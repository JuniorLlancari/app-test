<?php 
declare(strict_types=1);

namespace Src\Infrastructure\Interfaces;
use src\Dominio\Entities\User;

interface UserServiceInterface
{
    public function getUsersByPage(array $params) ;
    public function get(int $id): ?User;
    public function create(User $model) ;
    public function update(User $model): void;
    public function delete(int $id): void;
}
?>