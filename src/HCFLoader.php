<?php

namespace luissdeep\hcfaction;

use luissdeep\hcfaction\listener\ProfileListener;
use luissdeep\hcfaction\storage\LocalStorageService;
use luissdeep\hcfaction\storage\Repository;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class HCFLoader extends PluginBase {

    use SingletonTrait;

    public function onLoad(): void {
        self::setInstance($this);
    }

    public function onEnable(): void {
        $this->registerListeners(
            new ProfileListener()
        );
        LocalStorageService::getInstance()->addRepository(new Repository("profiles"));
    }

    public function registerListeners(Listener ...$listeners): void {
        foreach ($listeners as $listener) {
            $this->getServer()->getPluginManager()->registerEvents($listener, $this);
        }
    }

    public function onDisable(): void {
        LocalStorageService::getInstance()->removeRepositorys();
    }

}