<?php

namespace luissdeep\hcfaction\profile;

use luissdeep\hcfaction\storage\LocalStorageService;
use luissdeep\hcfaction\storage\Repository;
use pocketmine\utils\SingletonTrait;

class ProfileService {

    use SingletonTrait;

    public array $profiles = [];
    public ?Repository $repository = null;

    public function addProfile(Profile $profile): void {
        $this->profiles[$profile->getXuid()] = $profile;
    }

    public function getProfile(string $xuid): ?Profile {
        return $this->profiles[$xuid] ?? null;
    }

    public function removeProfile(string $xuid): void {
        unset($this->profiles[$xuid]);
    }

    public function getRepository(): Repository {
        if ($this->repository === null) {
            $this->repository = LocalStorageService::getInstance()->getRepository("profiles");
        }
        return $this->repository;
    }
}
