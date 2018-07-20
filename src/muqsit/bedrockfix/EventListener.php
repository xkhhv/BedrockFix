<?php

declare(strict_types=1);

namespace muqsit\bedrockfix;

use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\SetEntityDataPacket;

class EventListener implements Listener {

    public function onDataPacketReceive(DataPacketReceiveEvent $event) : void
    {
        $packet = $event->getPacket();
        if ($packet instanceof SetEntityDataPacket) { //thanks to @Driesboy for this
            $event->getPlayer()->respawnToAll();
        }
    }
}