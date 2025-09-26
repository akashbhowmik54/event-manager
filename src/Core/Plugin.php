<?php
namespace UltimateEventManager\Core;

use UltimateEventManager\Controllers\PostTypes\MemberPostType;
use UltimateEventManager\Controllers\PostTypes\TeamPostType;
use UltimateEventManager\MetaBoxes\MemberMetaBox;
use UltimateEventManager\MetaBoxes\TeamMetaBox;
use UltimateEventManager\Admin\AdminAssets;
use UltimateEventManager\Core\Hooks;
use UltimateEventManager\Admin\MemberAdminColumns;
use UltimateEventManager\Handlers\ContactFormHandler;
use UltimateEventManager\Handlers\MemberSubmissionHandler;
use UltimateEventManager\Frontend\FrontendAssets;

class Plugin {
    public static function init(): void {
        self::load_dependencies();

        // Register CPTs
        (new MemberPostType())->register();
        (new TeamPostType())->register();

        // Register Metaboxes
        (new MemberMetaBox())->register();
        (new TeamMetaBox())->register();

        // Register Assets
        (new AdminAssets())->register();
        (new FrontendAssets())->register();

        // Register Hooks
        (new Hooks())->register();

        (new MemberAdminColumns())->register();

        (new MemberSubmissionHandler())->register();

        ContactFormHandler::init();

        
    }

    

    private static function load_dependencies(): void {
        // Future includes: CPTs, hooks, shortcodes, etc.
    }
}
