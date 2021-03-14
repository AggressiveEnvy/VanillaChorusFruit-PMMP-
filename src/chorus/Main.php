<?php

namespace chorus;

use pocketmine\plugin\PluginBase;

use pocketmine\Player;

use pocketmine\math\Vector3;

use pocketmine\level\particle\GenericParticle;

use pocketmine\level\particle\Particle;

class Main extends PluginBase {

  function onEnable () {
    $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
  }

  static function randomFloat ($min = -0.9, $max = 0.9) {
    return $min+mt_rand()/mt_getrandmax() * ($max - $min);
  }

  static function randomTeleportation (Player $player) {
    $x = $player->getX();
    $y = $player->getY();
    $z = $player->getZ();
    for ($i = 0; $i <= 10; $i++) {
      $player->getLevel()->addParticle(new GenericParticle(new Vector3($x + Main::randomFloat(), $y + Main::randomFloat(0.5, 1.2), $z + Main::randomFloat()), Particle::TYPE_PORTAL));
    }
    $posTeleportation = [mt_rand($x - 10, $x + 10), mt_rand($y - 10, $y + 10), mt_rand($z - 10, $z + 10)];
    while ($player->getLevel()->getBlockIdAt($posTeleportation[0], $posTeleportation[1], $posTeleportation[2]) != 0) {
      $posTeleportation = [mt_rand($x - 10, $x + 10), mt_rand($y - 10, $y + 10), mt_rand($z - 10, $z + 10)];
    }
    $player->teleport(new Vector3($posTeleportation[0] + 0.5, $posTeleportation[1], $posTeleportation[2] + 0.5));
    for ($i = 0; $i <= 10; $i++) {
      $player->getLevel()->addParticle(new GenericParticle(new Vector3($player->getX() + Main::randomFloat(), $player->getY() + Main::randomFloat(0.5, 1.2), $player->getZ() + Main::randomFloat()), Particle::TYPE_PORTAL));
    }
  }
}
?>
