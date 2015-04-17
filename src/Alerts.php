<?php

namespace Dberry37388\Alerts;

use Dberry37388\Alerts\Contracts\Alerts as AlertsContract;
use Dberry37388\Alerts\Contracts\SessionStore as SessionStoreContract;
use Illuminate\Support\Collection;

/**
 * Part of the Alert package.
 *
 * Licensed under the MIT License
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Alert
 * @version    1.0.0
 * @author     Daniel Berry
 * @license    MIT License
 * @copyright  (c) 2015, Daniel Berry
 * @link       https://github.com/dberry37388/laravel5-alerts
 */

class Alerts extends Collection implements AlertsContract
{
	/**
	 * Name to use when storing our flash items into
	 * the session.
	 *
	 * @var string
	 */
	protected $sessionName;

	/**
	 * Holds SessionStore instance
	 *
	 * @var SessionStore
	 */
	protected $session;

	/**
	 * {@inheritDoc}
	 */
	public function alert($message, $type = 'info', $container = 'default', $flashable = true, $extras = [])
	{
		$alert = new Alert($message, $type, $container, $flashable, $extras);

		$key = md5($message.$type.$container.$flashable);

		if ($alert->isFlashable())
		{
			$this->session->flash($this->sessionName . '.' . $key, $alert);
		}
		else
		{
			$this->items[$key] = $alert;
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function whereInContainer($container)
	{
		if ( ! is_array($container)) $type = [$container];

		return $this->filter(function($alert) use ($container)
		{
			if ( ! is_array($container)) $container = [$container];

			if (in_array($alert->getContainer(), $container))
			{
				return true;
			}
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function whereNotInContainer($container)
	{
		if ( ! is_array($container)) $type = [$container];

		return $this->filter(function($alert) use ($container)
		{
			if ( ! is_array($container)) $container = [$container];

			if (! in_array($alert->getContainer(), $container))
			{
				return true;
			}
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function whereType($type)
	{
		if ( ! is_array($type)) $type = [$type];

		return $this->filter(function($alert) use ($type)
		{
			if ( ! is_array($type)) $type = [$type];

			if (in_array($alert->getType(), $type))
			{
				return true;
			}
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function whereNotType($type)
	{
		if ( ! is_array($type)) $type = [$type];

		return $this->filter(function($alert) use ($type)
		{
			if ( ! is_array($type)) $type = [$type];

			if (! in_array($alert->getType(), $type))
			{
				return true;
			}
		});
	}

	/**
	 * Dynamically forward methods
	 *
	 * @param $method
	 * @param $parameters
	 * @return Alerts
	 */
	public function __call($method, $parameters)
	{
		if (strpos($method, 'get') !== false)
		{
			$type = strtolower(substr($method, 3));

			$container = isset($parameters[0]) ? $parameters[0] : null;

			if ( ! is_null($container))
			{
				return $this->whereInContainer($container)->whereType($type);
			}

			return $this->whereType($type);
		}


		if (strpos($method, 'not') !== false)
		{
			$type = strtolower(substr($method, 3));

			$container = isset($parameters[0]) ? $parameters[0] : null;

			if ( ! is_null($container))
			{
				return $this->whereInContainer($container)->whereNotType($type);
			}

			return $this->whereType($type);
		}

		if (strpos($method, 'whereNot') !== false)
		{
			$container = lcfirst(substr($method, 8));

			$type = isset($parameters[0]) ? $parameters[0] : null;

			if ( ! is_null($type))
			{
				return $this->whereNotInContainer($container)->whereType($type);
			}

			return $this->whereNotInContainer($container);
		}

		if (strpos($method, 'where') !== false)
		{
			$container = lcfirst(substr($method, 5));

			$type = isset($parameters[0]) ? $parameters[0] : null;

			if ( ! is_null($type))
			{
				return $this->whereInContainer($container)->whereType($type);
			}

			return $this->whereInContainer($container);
		}

		list($message, $container, $flashable, $extras) = $this->parseParameters($parameters);

		return $this->alert($method, $message, $container, $flashable, $extras);
	}

	/**
	 * Parses parameters.
	 *
	 * @param  array  $parameters
	 * @return array
	 */
	protected function parseParameters($parameters)
	{
		$message = isset($parameters[0]) ? $parameters[0] : null;

		$container = isset($parameters[1]) ? $parameters[1] : 'default';

		$flashable = isset($parameters[2]) ? $parameters[2] : true;

		$extras = isset($parameters[3]) ? $parameters[3] : [];

		return [ $message, $container, $flashable, $extras ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function getSessionName()
	{
		return $this->sessionName;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setSessionName($sessionName)
	{
		$this->sessionName = $sessionName;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getSession()
	{
		return $this->session;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setSession(SessionStoreContract $session)
	{
		$this->session = $session;
	}
}