<?php

namespace Fucked;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\IPlayer;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\entity\Entity;


class MainClass extends PluginBase implements Listener{
    public function onEnable(){
        if (!file_exists('plugins/players')) {
            mkdir('plugins/players', 0777, true);
        }
    }

	public function onDisable(){
        //idk
    }

    public function PlayerJoinEvent(){
        $player = $this->getServer()->getPlayer($name);
        $ip = $player->getPlayer()->getAddress();
        $file = "plugins/players/" . $ip . ".txt";
        if (file_exists($file)) { //not sure if i done the top bit right
           //fk function goes here
        }
        else {
            //Nothing goes here
        }
    }

	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
	    $perms =[];
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
                    #send message
                    $sender->sendMessage($name . " is now fucked");
                    $player->sendMessage($name . ", Thank you for screwing up. Now you can suffer");

                    #record ip
                    $myfile = fopen("plugins/players/" . $ip . ".txt", "w") or die("Unable to open file!");;
                    fwrite($myfile, $ip);
                    fclose($myfile);

                    #change to adventure mode
                    $player->setGamemode(2);

                    //remove chat

                    #Invisible player
                    foreach($this->getServer()->getOnlinePlayers() as $tempPlayer) {
                        $tempPlayer->hidePlayer($player);
                    }

                    //disable pvp for $player

					return true;
				}
				else{
				    $sender->sendMessage("Player not online, Player Must be online");
                    return true;
				}
		}
	}
}
