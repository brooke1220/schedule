<?php

/**
 * @Author: brooke
 * @Date:   2019-05-27 16:41:29
 * @Last Modified by:   brooke
 * @Last Modified time: 2019-05-28 17:22:31
 */
namespace Brooke\Schedule;

use Brooke\Schedule\Console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class Run extends Command
{
    protected function configure()
    {
        $this->setName('schedule:run');
    }

    protected function execute(Input $input, Output $output)
    {
        //每天的上午十点和晚上八点执行这个命令
        $this->command('test')->twiceDaily(10, 20);

        parent::execute($input, $output);
    }
}
