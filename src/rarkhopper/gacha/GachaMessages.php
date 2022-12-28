<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

use pocketmine\utils\TextFormat;

class GachaMessages{
	public string $rollFailed = TextFormat::RED . 'チケットが足りません';
	public string $giveItemFailed = TextFormat::RED . 'インベントリに空がありません';
}
