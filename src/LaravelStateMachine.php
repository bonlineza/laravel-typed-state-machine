<?php

namespace TypedStateMachine\Laravel;

use TypedStateMachines\StateMachine;

class LaravelStateMachine extends StateMachine
{
	/**
     * Fires the provided event into the bus.
     *
     * @param IEvent $event
     * @return void
     */
    public function fireEvent(IEvent $event)
    {
        $class     = get_class($event);
        $listeners = $this->getListeners();

        if (array_key_exists($class, $listeners)) {
            foreach ($listeners[$class] as $listener) {
                /** @var IListener $listenerInstance */
                $listenerInstance = new $listener();
                $listenerInstance->handle($event);
            }
        }
    }
}