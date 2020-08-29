<?php
declare(strict_types=1);

namespace MixerApi\ExceptionRender;

use Cake\Console\CommandCollection;
use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use MixerApi\ExceptionRender\EntityValidationListener;

class Plugin extends BasePlugin
{
    /**
     * @param \Cake\Core\PluginApplicationInterface $app PluginApplicationInterface
     * @return void
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {
        new EntityValidationListener();

        parent::bootstrap($app);
    }
}
