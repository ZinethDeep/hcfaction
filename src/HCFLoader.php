<?php

namespace luissdeep\hcfaction;

use luissdeep\hcfaction\storage\LocalStorageService;
use luissdeep\hcfaction\storage\Repository;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class HCFLoader extends PluginBase {

    use SingletonTrait;

    public function onLoad(): void {
        self::setInstance($this);
    }

    public function onEnable(): void {
        LocalStorageService::getInstance()->addRepository(new Repository("profiles"));
    }

    public function onDisable(): void {
        LocalStorageService::getInstance()->removeRepositorys();
    }

}