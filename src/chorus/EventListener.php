<?php

namespace chorus;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerItemConsumeEvent;

use pocketmine\item\Item;

class EventListener implements Listener {

 function onConsumeEvent (PlayerItemConsumeEvent $event) {
   $player = $event->getPlayer();
   if ($event->getItem()->getId() == 432) {
     $event->setCancelled();
     $player->getInventory()->removeItem(Item::get(432));
     $player->setFood($player->getFood() + 4);
     Main::randomTeleportation($player);
   }
 }
}
?>
