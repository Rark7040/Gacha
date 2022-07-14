<?php
declare(strict_types=1);
namespace rarkhopper\gacha;

class GachaHolder{
	/** @var array<string, Gacha> */
	protected array $gacha_list = [];

	public function create(string $title, string $description, ItemTable $items, ITicket $ticket):Gacha{
		return new Gacha($title, $description, $items, $ticket); //TODO runtime idで管理,,,?
	}
}