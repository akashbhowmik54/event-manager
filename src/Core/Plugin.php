<?php
namespace UltimateEventManager\Core;

use UltimateEventManager\PostTypes\EventPostType;
use UltimateEventManager\MetaBoxes\EventMetaBox;
use UltimateEventManager\Handlers\ContactFormHandler;
use UltimateEventManager\Shortcodes\EventForm;
use UltimateEventManager\Frontend\FrontendAssets;

class Plugin {
    public static function init(): void {
        self::load_dependencies();

        // Register CPTs
        (new EventPostType())->register();
        (new EventMetaBox())->register();
        (new FrontendAssets())->register();

        new ContactFormHandler();
        new EventForm();
        
    }
    private static function load_dependencies(): void {
        // Future includes: CPTs, hooks, shortcodes, etc.
    }
}
