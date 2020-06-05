<?php

/**
 * Copyright (C) 2018-2019  CzechPMDevs
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace czechpmdevs\buildertools\commands;

use czechpmdevs\buildertools\BuilderTools;
use czechpmdevs\buildertools\Selectors;
use pocketmine\command\CommandSender;
use pocketmine\level\Position;
use pocketmine\Player;


/**
 * Class SecondPositionCommand
 * @package buildertools\commands
 */
class SecondPositionCommand extends BuilderToolsCommand {

    /**
     * SecondPositionCommand constructor.
     */
    public function __construct() {
        parent::__construct("/pos2", "Select second position", null, ["/2"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$this->testPermission($sender)) return;

        if(!$sender instanceof Player) {
            $sender->sendMessage("§cThis command can be used only in game!");
            return;
        }
        if (isset($args[0])) {
            if (isset($args[1])) {
                if (isset($args[2])) {
                    Selectors::addSelector($sender, 2, $position = new Position((int)intval($args[0]), (int)intval($args[1]), (int)intval($args[2]), $sender->getLevel()));
                    $sender->sendMessage(BuilderTools::getPrefix()."§aSelected first position at {$position->getX()}, {$position->getY()}, {$position->getZ()}");
                                return;
                }
            }
            $sender->sendMessage("§cInvalid coordinates given!");
            return;
        }
        Selectors::addSelector($sender, 2, $position = new Position((int)intval($sender->getX()), (int)intval($sender->getY()), (int)intval($sender->getZ()), $sender->getLevel()));
        $sender->sendMessage(BuilderTools::getPrefix()."§aSelected second position at {$position->getX()}, {$position->getY()}, {$position->getZ()}");
    }
}