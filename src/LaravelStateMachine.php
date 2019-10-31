<?php

namespace TypedStateMachine\Laravel;

use Bagf\Dynamic\Builder as DynamicBuilder;
use Illuminate\Queue\SerializesModels;
use TypedStateMachines\IEvent;
use TypedStateMachines\StateMachine;

class LaravelStateMachine extends StateMachine
{
	/**
     * Overrides the fireEvent if StateMachine to use Laravel's event system.
     * Shout out to @bagf for bagf/dynamic which made this neat and easy. 
     * Give it a star!
     *
     * @param IEvent $event
     * @return void
     */
    public function fireEvent(IEvent $event)
    {
        $event = DynamicBuilder::fromInstance($event)
            ->shareTrait(SerializesModels::class)
            ->instance();

        event($event);
    }
}