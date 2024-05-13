<?php

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Chats extends Command
{
    protected function configure()
    {
        $this->setName('Chats')->setDescription('删除超8小时的用户会话');
    }

    protected function execute(Input $input, Output $output)
    {
        $delTime = time() - 28800;
       $database = require CONF_PATH.'../config/database.php';
        Db::connect($database)->table('wolive_chats')->where('timestamp','<=', $delTime)->delete();
        $output->writeln("success");
    }
}