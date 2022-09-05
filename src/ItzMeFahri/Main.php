<?php
#------------------------------------#
         #PLUGIN BY ItzMeFahri#
             #SUBSCRIBE
      #CHANELL ItzMeFahri
#------------------------------------#
namespace ItzMeFahri;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {
  
    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
      $commandname = $command->getName();
      if($commandname == "gmui"){
          if($sender instanceof Player){
            $this->gmui($sender);
          }
      }
      return true;
    }
    
    public function gmui(Player $player){
        $form = new SimpleForm(function (Player $player, int $data = null){
          if($data === null){
            return;
          }
          switch ($data) {
              case 0:
                  $player->setGamemode(GameMode::SURVIVAL());
                  $player->sendMessage("§d>>successfully changed gamemode>>");
              break;
              
              case 1:
                  $player->setGamemode(GameMode:: CREATIVE());
                  $player->sendMessage("§d>>successfully changed gamemode>>");
              break;
              
              case 2:
                  $player->setGamemode(GameMode:: SPECTATOR());
                  $player->sendMessage("§d>>successfully changed gamemode>>");
              break;
          }
        });
        $form->setTitle($this->getConfig()->get("Title"));
        $form->setContent($this->getConfig()->get("Content"));
        $form->addButton("§dSURVIVAL");
        $form->addButton("§dCREATIVE");
        $form->addButton("§dSPECTATOR");
        $player->sendForm($form);
        return $form;
    }
}
?>