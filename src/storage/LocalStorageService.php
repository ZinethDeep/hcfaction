<?php

namespace luissdeep\hcfaction\storage;

use pocketmine\utils\SingletonTrait;

class LocalStorageService {

    use SingletonTrait;

    public array $repositories = [];

    public function addRepository(Repository $repository): void {
        $this->repositories[$repository->name] = $repository;
    }

    public function getRepository(string $name): ?Repository {
        return $this->repositories[$name] ?? null;
    }

    public function removeRepository(string $name): void {
        unset($this->repositories[$name]);
    }

    public function removeRepositorys(): void {
        foreach ($this->repositories as $repository) {
            $repository->close();
        }
        unset($this->repositories);
    }

}