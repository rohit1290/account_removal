<?php

namespace ColdTrick\AccountRemoval\Notifications;

use Elgg\Notifications\InstantNotificationEventHandler;

class Notify extends InstantNotificationEventHandler {
	
	protected function getNotificationSubject(\ElggUser $recipient, string $method): string {
		return elgg_echo("account_removal:message:".$this->getParam('type').":subject", [$this->getParam('site_name')]);
	}
	
	protected function getNotificationBody(\ElggUser $recipient, string $method): string {
		$user = $this->event->getObject();
		if (!$user instanceof \ElggUser) {
			return parent::getNotificationBody($recipient, $method);
		}
		
		$url = elgg_normalize_url(
			"account_removal/{$this->getParam('username')}/confirm/{$this->getParam('type')}?confirm_token={$this->getParam('token')}"
		);
		return elgg_echo("account_removal:message:".$this->getParam('type').":body", [
			$url,
  	]);
	}
	
	protected function getNotificationMethods(): array {
		return ['email'];
	}
}