<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

use pocketmine\player\Player;

interface ITicket{
	public function has(Player $player, int $count) : bool;
	public function consume(Player $player, int $count) : void;
}
