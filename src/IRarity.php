<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

interface IRarity{
	public function getName();
	/** @return float 0.0 ~ 100.0 */
	public function getEmissionPercent():float;
}