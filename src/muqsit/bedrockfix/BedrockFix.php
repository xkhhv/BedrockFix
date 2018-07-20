<?php

declare(strict_types=1);

namespace muqsit\bedrockfix;

use pocketmine\plugin\PluginBase;

class BedrockFix extends PluginBase {

    public function onEnable() : void
    {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
}