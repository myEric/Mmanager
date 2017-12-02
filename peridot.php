<?php
use Evenement\EventEmitterInterface;
use Peridot\Plugin\Watcher\WatcherPlugin;

<<<<<<< HEAD
return function(EventEmitterInterface $emitter) {
    new WatcherPlugin($emitter);
=======
return function(EventEmitterInterface $emitter)
{
	$watcher = new WatcherPlugin($emitter);
>>>>>>> f89ed31b341a0f92418faa2cdec97b0f0e58244b
};