<?php

declare(strict_types=1);

namespace rarkhopper\gacha;

use InvalidArgumentException;
use RuntimeException;
use function array_rand;
use function count;

class RandomItemTable extends ItemTable{
	/**
	 * @return IGachaItem[]
	 * @throws InvalidArgumentException | RuntimeException
	 */
	public function pop(int $count) : array{
		if($count < 1) throw new InvalidArgumentException('count must be greater than zero');
		$result = [];

		for(; $count !== 0; --$count){
			$result[] = $this->randomPop();
		}
		return $result;
	}

	/**
	 * @throws RuntimeException
	 */
	protected function randomPop() : IGachaItem{
		if(count($this->table) === 0) throw new RuntimeException('table is empty');
		for($i = 0; $i < 1000; ++$i){
			$k = array_rand($this->table);

			if($this->calcPercent($k / 100)){
				$items = $this->table[$k];
				return $items[array_rand($items)];
			}
		}
		$randItems = $this->table[array_rand($this->table)];
		return  $randItems[array_rand($randItems)];
	}
}
