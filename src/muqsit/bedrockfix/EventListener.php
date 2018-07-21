<?php

declare(strict_types=1);

namespace muqsit\bedrockfix;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\SetEntityDataPacket;
use pocketmine\event\player\PlayerInteractEvent;

class EventListener implements Listener {

        protected $PlayerData;
    
        /** @var array $taps */
        public $taps = [];
    
    public function onDataPacketReceive(DataPacketReceiveEvent $event) : void
    {
        $packet = $event->getPacket();
        if ($packet instanceof LoginPacket) {
             $this->PlayerData[$packet->username] = $packet->clientData;
        }
        if ($packet instanceof SetEntityDataPacket) { //thanks to @Driesboy for this
            $event->getPlayer()->respawnToAll();
        }
    }
    
    public function onInteract(PlayerInteractEvent $event) : void
    {
    $player = $event->getPlayer();
     $os = ["Unknown", "Android", "iOS", "macOS", "FireOS", "GearVR", "HoloLens", "Windows 10", "Windows", "Dedicated", "Orbis", "NX"];
     $cdata = $this->PlayerData[$player->getName()];
     if ($os[$cdata["DeviceOS"]] == "Windows" or $os[$cdata["DeviceOS"]] == "Windows 10") {
      if ($event->getAction() == $event::RIGHT_CLICK_BLOCK) {
         $this->taps[$player->getName()]++;
         $event->setCancelled($this->taps[$player->getName()] < 7);           
         if ($this->taps[$player->getName()] == 7) {
         $this->taps[$player->getName()] == 0;           
         }
     }else{
         $this->taps[$player->getName()] = 0;
      }else{
         $this->taps[$player->getName()] = 0;
      }
     }
    }
    
}
