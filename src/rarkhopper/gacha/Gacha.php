<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

use pocketmine\player\Player;

class Gacha{
	protected string $name;
	protected string $description;
	protected ItemTable $table;
	protected ITicket $ticket;

	public function __construct(string $name, string $description, ItemTable $table, ITicket $ticket){
		$this->name = $name;
		$this->description = $description;
		$this->table = $table;
		$this->ticket = $ticket;
	}

	public function getName():string{
		return $this->name;
	}

	public function getDescription():string{
		return $this->description;
	}

	/**
	 * @return array<IGachaItem>
	 */
	public function roll(Player $player, int $count):array{
		if($count < 1) throw new \LogicException('count must be greater than zero');
		if($this->canRoll($player, $count)) return [];
		return $this->table->pop($count);
	}

	public function canRoll(Player $player, int $count):bool{
		return $this->ticket->has($player, $count);
	}
}