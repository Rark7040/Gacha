<?php
declare(strict_types=1);

namespace rarkhopper\gacha;

abstract class ItemTable{
	/** @var \SplFixedArray<int, array> */
	protected \SplFixedArray $table;
	/** @var IGachaItem はずれの場合付与 */
	protected IGachaItem $fallback;

	/** @return array<IGachaItem> */
	abstract public function pop(int $count):array;

	public function __construct(IGachaItem $fallback_item, IGachaItem ...$items){
		$this->table = new \SplFixedArray(100);
		$this->fallback = $fallback_item;

		if(count($items) === 0){
			throw new \LogicException('ItemTable::__construct()::$items is expects to be IGachaItems of 1 or more.');
		}
		$this->putItems(...$items);
	}

	protected function putItems(IGachaItem ...$items):void{
		foreach($items as $item){
			$rarity = $item->getRarity();
			$emmit_per = $rarity->getEmissionPercent();

			if(!$this->validateEmmitPer($emmit_per)){
				throw new \LogicException('IGachaItem::getEmissionPercent() was returned invalid value. @see line 9 in IGachaItem');
			}
			$this->table[$emmit_per][] = $item;
		}
	}

	protected function validateEmmitPer(float $emmit_per):bool{
		return $emmit_per >= 0 && $emmit_per <= 100;
	}
}