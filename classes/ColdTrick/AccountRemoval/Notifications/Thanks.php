<?php

namespace ColdTrick\AccountRemoval\Notifications;

use Elgg\Notifications\InstantNotificationEventHandler;

class Thanks extends InstantNotificationEventHandler {
	
	protected function getNotificationSubject(\ElggUser $recipient, string $method): string {
		return elgg_echo("account_removal:message:thank_you:".$this->getParam('type').":subject", [$this->getParam('site_name')]);
	}
	
	protected function getNotificationBody(\ElggUser $recipient, string $method): string {
		$user = $this->event->getObject();
		if (!$user instanceof \ElggUser) {
			return parent::getNotificationBody($recipient, $method);
		}
		
		return elgg_echo("account_removal:message:thank_you:".$this->getParam('type').":body", [
			$this->getParam('site_name'),
		]);
	}
	
	protected function getNotificationMethods(): array {
		return ['email'];
	}
}