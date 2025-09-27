<?php
namespace UltimateEventManager\Core;

use UltimateEventManager\PostTypes\EventPostType;
use UltimateEventManager\MetaBoxes\EventMetaBox;
use UltimateEventManager\Handlers\ContactFormHandler;

class Plugin {
    public static function init(): void {
        self::load_dependencies();

        // Register CPTs
        (new EventPostType())->register();
        (new EventMetaBox())->register();

        new ContactFormHandler();
        
    }
    private static function load_dependencies(): void {
        // Future includes: CPTs, hooks, shortcodes, etc.
    }
}
