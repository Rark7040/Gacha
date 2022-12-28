<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

class Rarity implements IRarity{
	protected string $name;
	protected float $emmitPer;

	public static function create(string $name, float $emmitPer) : self{
		$instance = new self();
		$instance->name = $name;
		$instance->emmitPer = $emmitPer;
		return $instance;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getEmissionPercent() : float{
		return $this->emmitPer;
	}
}
