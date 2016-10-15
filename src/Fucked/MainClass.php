<?php

namespace Fucked;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\IPlayer;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;

class MainClass extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!is_dir($this->getDataFolder()."../Fkplayers/ip")){
			@mkdir($this->getDataFolder()."../Fkplayers/ip", 0777, true);
		}
    }

	public function onDisable(){
        //idk
    }

    public function onJoin(){
        //check if ip match, then fked them
    }

	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		switch($command->getName()){
			case "fk":
				if(!isset($args[0])){
					$sender->sendMessage("Your forgot to add username, /fk Steve");
					return true;
				}
				$name = strtolower($args[0]);
				$player = $this->getServer()->getPlayer($name);
				if($player instanceOf Player){
					$ip = $player->getPlayer()->getAddress();
                    $sender->sendMessage($ip);
                    //record ip for other accounts ../Fkplayers/ip/.......
                    //set gamemode to adventure
                    //remove chat
                    //remove commands (via pureperms)
                    //make invisible
                    //kick the out of the server for every 5min online saying 'You Fucked Up'
					return true;
				}
				else{
				    $sender->sendMessage("Player not online, Player Must be online");
                    return true;
				}
		}
	}
}