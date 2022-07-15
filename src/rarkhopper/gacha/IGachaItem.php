<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

use pocketmine\player\Player;

interface IGachaItem{
	public function getRarity():IRarity;
	public function giveItem(Player $player):void;
}