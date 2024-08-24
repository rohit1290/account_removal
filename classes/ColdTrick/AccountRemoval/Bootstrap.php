<?php

namespace ColdTrick\AccountRemoval;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {

	/**
	 * {@inheritDoc}
	 */
	public function init() {
    elgg_register_event_handler('register', 'menu:page', '\ColdTrick\AccountRemoval\PageMenu::settingsMenu');
	}
}