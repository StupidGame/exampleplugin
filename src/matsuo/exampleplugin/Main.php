<?php

namespace matsuo\exampleplugin;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use matsuo\TeamAPI\TeamAPI;

class Main extends PluginBase{
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        switch($command->getName()){
          case "maketeam":
            $forma = Server::getInstance()->getPluginManager()->getPlugin('FormAPI')->createCustomForm(function($player, $data){$player->sendMessage($data[1]);});
            $forma->setTitle('テスト');
            $forma->addLabel('test');
            $forma->addInput("" , "チーム名を入力");
            $forma->sendToPlayer($sender->getPlayer());
             return true;    
             break;
            case "jointeam":
              $playerName = [];
              $players = Server::getInstance()->getOnlinePlayers();
              foreach ($players as $player) {
                 $name = $player->getName();
                 $playerName[] = $name;
               } 
                $formb = Server::getInstance()->getPluginManager()->getPlugin('FormAPI')->createSimpleForm(function($player, $data) use($playerName){$player->sendMessage($playerName[$data]."を選択しました");});
                $formb->setTitle('タイトル');
                $formb->setContent('本文');
                foreach($playerName as $value){
                  $formb -> addButton($value."を選択");
                }  
    
                $formb->sendToPlayer($sender->getPlayer());
                return true;
                default:
                return false;
           
          }
        }            
    
}