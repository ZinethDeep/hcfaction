<?php

namespace luissdeep\hcfaction\listener;

use luissdeep\hcfaction\profile\Profile;
use luissdeep\hcfaction\profile\ProfileService;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class ProfileListener implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        ProfileService::getInstance()->addProfile(new Profile($player->getXuid(), $player->getName()));
    }

    public function onQuit(PlayerQuitEvent $event): void {
        $player = $event->getPlayer();
        ProfileService::getInstance()->removeProfile($player->getXuid());
    }

}