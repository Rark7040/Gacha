<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

class Rarity implements IRarity{
	protected string $name;
	protected float $emmit_per;

	public static function create(string $name, float $emmit_per):static{
		$instance = new static;
		$instance->name = $name;
		$instance->emmit_per = $emmit_per;
		return $instance;
	}

	public function getName():string{
		return $this->name;
	}

	public function getEmissionPercent():float{
		return $this->emmit_per;
	}
}