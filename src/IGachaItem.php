<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

use pocketmine\player\Player;

interface IGachaItem{
	/** @return float 0.0 ~ 100.0 */
	public function getEmissionPercent():float; //TODO validate
	public function giveItem(Player $player):void;
}