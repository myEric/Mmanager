<?php
use Evenement\EventEmitterInterface;
use Peridot\Plugin\Watcher\WatcherPlugin;

return function(EventEmitterInterface $emitter) {
    new WatcherPlugin($emitter);
return function(EventEmitterInterface $emitter)
{
	$watcher = new WatcherPlugin($emitter);
};