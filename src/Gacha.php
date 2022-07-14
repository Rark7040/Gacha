<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

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
}