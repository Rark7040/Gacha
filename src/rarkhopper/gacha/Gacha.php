<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

use LogicException;
use pocketmine\player\Player;

class Gacha{
	protected string $name;
	protected string $description;
	protected GachaMessages $messages;
	protected ItemTable $table;
	protected ITicket $ticket;

	public function __construct(string $name, string $description, GachaMessages $messages, ItemTable $table, ITicket $ticket){
		$this->name = $name;
		$this->description = $description;
		$this->messages = $messages;
		$this->table = $table;
		$this->ticket = $ticket;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getDescription() : string{
		return $this->description;
	}

	public function getMessages() : GachaMessages{
		return $this->messages;
	}

	public function getTable() : ItemTable {
		return $this->table;
	}

	public function getTicket() : ITicket {
		return $this->ticket;
	}

	/**
	 * @throws LogicException
	 */
	public function roll(Player $player, int $count) : void{
		if($count < 1) throw new LogicException('count must be greater than zero');
		if(!$this->canRoll($player, $count)){
			$player->sendMessage($this->messages->rollFailed);
			return;
		}
		$giveCount = 0;

		foreach($this->table->pop($count) as $item){
			if($item->giveItem($player)){
				++$giveCount;

			}else{
				$player->sendMessage($this->messages->giveItemFailed);
			}
		}
		$this->ticket->consume($player, $giveCount);
	}

	public function canRoll(Player $player, int $count) : bool{
		return $this->ticket->has($player, $count);
	}
}
