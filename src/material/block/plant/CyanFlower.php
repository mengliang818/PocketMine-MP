<?php

/*

           -
         /   \
      /         \
   /   PocketMine  \
/          MP         \
|\     @shoghicp     /|
|.   \           /   .|
| ..     \   /     .. |
|    ..    |    ..    |
|       .. | ..       |
\          |          /
   \       |       /
      \    |    /
         \ | /

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.


*/

class CyanFlowerBlock extends FlowableBlock{
	public function __construct(){
		parent::__construct(CYAN_FLOWER, 0, "Cyan Flower");
	}

	public function place(Item $item, Player $player, Block $block, Block $target, $face, $fx, $fy, $fz){
			$down = $this->getSide(0);
			if($down->getID() === 2 or $down->getID() === 3 or $down->getID() === 60){
				$this->level->setBlock($block, $this);
				return true;
			}
		return false;
	}

	public function onUpdate($type){
		if($type === BLOCK_UPDATE_NORMAL){
			if($this->getSide(0)->isTransparent === true){ //Replace wit common break method
				ServerAPI::request()->api->entity->drop($this, BlockAPI::getItem($this->id));
				$this->level->setBlock($this, new AirBlock(), false);
				return BLOCK_UPDATE_NORMAL;
			}
		}
		return false;
	}
}