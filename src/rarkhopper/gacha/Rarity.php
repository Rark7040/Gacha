<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

class Rarity implements IRarity{
	protected string $name;
	protected float $emmitPer;

	public function __construct(string $name, float $emmitPer){
		$this->name = $name;
		$this->emmitPer = $emmitPer;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getEmissionPercent() : float{
		return $this->emmitPer;
	}
}
