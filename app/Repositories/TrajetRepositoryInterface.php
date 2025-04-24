<?php
namespace App\Repositories;

interface TrajetRepositoryInterface {
    public function all();
    public function find($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
    public function search(array $filters);
    public function getPopularRoutes();
}
