<?php
declare(strict_types=1);

namespace rarkhopper\gacha;


class RandomItemTable extends ItemTable{
	/**
	 * @throws \Exception
	 * @return array<IGachaItem>
	 */
	public function pop(int $count):array{
		if($count < 1) throw new \LogicException('count must be greater than zero');
		$result = [];

		for(; $count !== 0; --$count){
			$result[] = $this->randomPop();
		}
		return $result;
	}

	/**
	 * @throws \Exception
	 */
	protected function randomPop():IGachaItem{
		if(count($this->table) === 0) throw new \LogicException('table is empty');
		for($i = 0; $i < 1000; ++$i){
			$k = array_rand($this->table);

			if($this->calcPercent($k/100)){
				$items = $this->table[$k];
				return $items[array_rand($items)];
			}
		}
		throw new \Exception('Loop is too long');
	}
}