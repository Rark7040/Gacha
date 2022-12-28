<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

use pocketmine\player\Player;

interface IGachaItem{
	public function getRarity() : IRarity;

	/**
	 * @return bool
	 * もしアイテムの付与に失敗した場合falseを返します
	 */
	public function giveItem(Player $player) : bool;
}
