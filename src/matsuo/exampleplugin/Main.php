<?php

namespace matsuo\exampleplugin;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use matsuo\TeamAPI\TeamAPI;

class hoge extends PluginBase{
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        switch($command->getName()){
          case "maketeam":
            $form = Server::getInstance()->getPluginManager()->getPlugin('FormAPI')->createCustomForm(function($player, $data) use($playerName){$player->sendmessage("$data");});
            $form->setTitle('テスト');
            $form->addLavel('test');
            $form->addImput("" , "チーム名を入力");
            case "jointeam":
              $playerName = [];
              $players = Server::getInstance()->getOnlinePlayers();
              foreach ($players as $player) {
                 $name = $player->getName();
                 $playerName[] = $name;
               } 
                $form = Server::getInstance()->getPluginManager()->getPlugin('FormAPI')->createSimpleForm(function($player, $data) use($playerName){$player->sendMessage($playerName[$data]."を選択しました");});
                $form->setTitle('タイトル');
                $form->setContent('本文');
                foreach($playerName as $value){
                  $form -> addButton($value."を選択");
                }  
    
                $form->sendToPlayer($sender->getPlayer());
                return true;
                default:
                return false;
           
          }
        }            
    
}