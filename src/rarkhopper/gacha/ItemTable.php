<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

abstract class ItemTable{
	/** @var array<int, array<IGachaItem>> キーは排出確率に100をかけた数 */
	protected array $table = [];

	/** @return array<IGachaItem> */
	abstract public function pop(int $count):array;

	/**
	 * @param IGachaItem ...$items
	 */
	public function __construct(IGachaItem ...$items){
		if(count($items) === 0){
			throw new \LogicException('ItemTable::__construct()::$items is expects to be IGachaItems of 1 or more.');
		}
		$this->putItems(...$items);
	}

	/**
	 * @param IGachaItem ...$items
	 * @return void
	 */
	protected function putItems(IGachaItem ...$items):void{
		foreach($items as $item){
			$rarity = $item->getRarity();
			$emmit_per = $rarity->getEmissionPercent();

			if(!$this->validateEmmitPer($emmit_per)){
				throw new \LogicException('IGachaItem::getEmissionPercent() was returned invalid value. @see line 8 in IRarity');
			}
			$this->table[(int) round($emmit_per*100, 0, PHP_ROUND_HALF_ODD)][] = $item;
		}
	}

	/**
	 * @param float $emmit_per
	 * @return bool
	 */
	protected function validateEmmitPer(float $emmit_per):bool{
		return $emmit_per >= 0 && $emmit_per <= 100;
	}

	/**
	 * @param float $percent 0.00 ~ 100.00
	 * @return bool
	 * @throws \Exception
	 */
	protected function calcPercent(float $percent):bool{
		return round($percent*100, 0, PHP_ROUND_HALF_ODD) >= random_int(1, 10000);
	}
}