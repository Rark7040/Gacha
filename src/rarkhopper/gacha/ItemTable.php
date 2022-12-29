<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

use InvalidArgumentException;
use LogicException;
use function count;
use function mt_rand;
use function round;
use const PHP_ROUND_HALF_ODD;

abstract class ItemTable{
	/**
	 * @var array<int, array<IGachaItem>>
	 * キーは排出確率に100をかけた数
	 */
	protected array $table = [];

	/**
	 * @return array<IGachaItem>
	 */
	abstract public function pop(int $count) : array;

	/**
	 * @throws LogicException
	 */
	public function __construct(IGachaItem ...$items){
		if(count($items) === 0) throw new LogicException('items is expects to be IGachaItems of amount 1 or more.');
		$this->putItems(...$items);
	}

	/**
	 * @param float $percent 0.00 ~ 100.00
	 * @return bool 排出可能であればtrueを返す
	 * @throws InvalidArgumentException
	 */
	protected function calcPercent(float $percent) : bool{
		if(!$this->validateEmmitPer($percent)) throw new InvalidArgumentException('calc per is must be a between 0 and 100');
		return round($percent * 100, 0, PHP_ROUND_HALF_ODD) >= mt_rand(1, 10000);
	}

	/**
	 * @throws LogicException
	 */
	private function putItems(IGachaItem ...$items) : void{
		foreach($items as $item){
			$rarity = $item->getRarity();
			$emmit_per = $rarity->getEmissionPercent();

			if(!$this->validateEmmitPer($emmit_per)){
				throw new LogicException('IGachaItem::getEmissionPercent() was returned invalid value.');
			}
			$this->table[(int) round($emmit_per * 100, 0, PHP_ROUND_HALF_ODD)][] = $item;
		}
	}

	private function validateEmmitPer(float $emmitPer) : bool{
		return $emmitPer >= 0 && $emmitPer <= 100;
	}
}
