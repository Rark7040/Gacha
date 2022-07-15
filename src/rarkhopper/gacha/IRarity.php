<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

interface IRarity{
	public function getName();
	/** @return float 0.01 ~ 100.00 */
	public function getEmissionPercent():float;
}