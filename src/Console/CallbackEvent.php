<?php

/**
 * @Author: brooke
 * @Date:   2019-05-27 17:44:43
 * @Last Modified by:   brooke
 * @Last Modified time: 2019-05-27 19:15:30
 */
namespace brooke\schedule\Console;

use think\Container;
use Api\Exceptions\InvalidArgumentException;

class CallbackEvent extends Event
{
    protected $callback;

    protected $parameters;

    public function __construct($callback, array $parameters = [])
    {
        if (! is_string($callback) && ! is_callable($callback)) {
            throw new InvalidArgumentException(
                'Invalid scheduled callback event. Must be a string or callable.'
            );
        }

        $this->callback = $callback;

        $this->parameters = $parameters;
    }

    /**
     * Run the given event.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return mixed
     *
     * @throws \Exception
     */
    public function run(Container $container)
    {
        $this->callBeforeCallbacks($container);

        try {
            $response = $container->invokeFunction($this->callback, $this->parameters);
        } finally {
            parent::callAfterCallbacks($container);
        }

        return $response;
    }
}