
___
# Virion library for Gacha

プラグイン開発者向けのガチャ用ライブラリ<br>
<br>

## 環境
<strong>PHP 8.0</strong> <br>
<strong>PocketMine-M</strong>P 4.0.0 <br>
<br>


## インストール
1. [VirionTools](https://github.com/ifera-mc/VirionTools)を`plugins`の中に配置します
2. サーバーを再起動します
3. `plugin_data/VirionTools/builds`にダウンロードした`Gacha.phar`を配置します
4. コマンドラインより、`$ iv Gacha [導入したいプラグインの名前]`を実行します <br>
<br>

## サンプル
[サンプルコード]<br>
https://github.com/Rark7040/GachaExample <br>

<br>

```php
$gacha = new Gacha(
	'TestGacha',
	'example',
	new RandomItemTable(
		PMGachaItem::create(Rarity::create('N', 60), VanillaItems::COAL()),
		PMGachaItem::create(Rarity::create('R', 20), VanillaItems::IRON_INGOT()),
		PMGachaItem::create(Rarity::create('SR', 8), VanillaItems::GOLD_INGOT()),
		PMGachaItem::create(Rarity::create('SSR', 3), VanillaItems::DIAMOND()),
		PMGachaItem::create(Rarity::create('UR', 0.6), VanillaItems::EMERALD()),
	),
	new ExampleTicket
);

$gacha->roll($player, 'チケットが足りません', 1);
```
<details>
<summary> Other Code</summary>

```php
<?php
declare(strict_types=1);

namespace rarkhopper\gacha_example;

use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\world\sound\PopSound;
use rarkhopper\gacha\IGachaItem;
use rarkhopper\gacha\IRarity;
use rarkhopper\gacha\Rarity;

class PMGachaItem implements IGachaItem{
	protected Rarity $rarity;
	protected Item $item;

	public static function create(Rarity $rarity, Item $item):static{
		$instance = new static;
		$instance->rarity = $rarity;
		$instance->item = $item;
		return $instance;
	}

	public function getRarity():IRarity{
		return $this->rarity;
	}

	public function giveItem(Player $player):void{
		$player->sendMessage('['.$this->getRarity()->getName().'] '.$this->item->getName());
		$player->getInventory()->addItem(clone $this->item);
		$world = $player->getWorld();
		$world->addSound($player->getPosition(), new PopSound());
	}
}
```

```php
<?php
declare(strict_types=1);

namespace rarkhopper\gacha_example;

use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use rarkhopper\gacha\ITicket;

class ExampleTicket implements ITicket{
	public function has(Player $player, int $count):bool{
		return $player->getInventory()->contains(VanillaItems::GOLD_NUGGET()->setCount($count));
	}

	public function consume(Player $player, int $count):void{
		$player->getInventory()->removeItem(VanillaItems::GOLD_NUGGET()->setCount($count));
	}
}
```

</details>

---