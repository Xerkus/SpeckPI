<?php

namespace SpeckPI\Service;

use SpeckCart\Service\CartEvent;

class PIService
{
    protected $piMapper;
    protected $eventManager;

    public function postAddItem(CartEvent $e)
    {
        if (!$e->hasParam('performance_indicators')) {
            return;
        }

        $indicators = $e->getParam('performance_indicators');

        foreach ($indicators as $i) {
            $this->getPIMapper()->persist($i);
        }
    }

    public function attachDefaultListeners()
    {
        $events = $this->getEventManager();
        $events->attach(CartEvent::EVENT_ADD_ITEM_POST, array($this, 'postAddItem'));
    }

    public function getPIMapper()
    {
        return $this->piMapper;
    }

    public function setPIMapper($piMapper)
    {
        $this->piMapper = $piMapper;
        return $this;
    }

    public function getEventManager()
    {
        return $this->eventManager;
    }

    public function setEventManager($eventManager)
    {
        $this->eventManager = $eventManager;
        return $this;
    }
}