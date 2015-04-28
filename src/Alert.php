<?php

namespace Dberry37388\Alerts;

use Dberry37388\Alerts\Contracts\Alert as AlertContract;

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

class Alert implements AlertContract
{
	/**
	 * The alert's message body
	 *
	 * @var string
	 */
	protected $message;

	/**
	 * Container the alert belongs to
	 *
	 * @var string
	 */
	protected $container;

	/**
	 * Type of alert
	 *
	 * @var
	 */
	protected $type;

	/**
	 * Flashable to session or instant message
	 *
	 * @var bool
	 */
	protected $flashable;

	/**
	 * Any extra attributes
	 *
	 * @var array|null
	 */
	protected $extra = [];

	/**
	 * Creates a new Alert instance
	 *
	 * @param $message
	 * @param $type
	 * @param string $container
	 * @param bool $flashable
	 * @param array $extra
	 */
	public function __construct($message, $type, $container = 'default', $flashable = true, $extra = [])
	{
		$this->message = $message;

		$this->type = $type;

		$this->container = $container;

		$this->flashable = $flashable;

		$this->extra = $extra;
	}

	/**
	 * Returns the Alert's message
	 *
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Set's the alert's message
	 *
	 * @param string $message
	 */
	public function setMessage($message)
	{
		$this->message = $message;
	}

	/**
	 * Return the container that the alert belongs to
	 *
	 * @return string
	 */
	public function getContainer()
	{
		return $this->container;
	}

	/**
	 * Sets the container that the alert belongs to
	 *
	 * @param string $container
	 */
	public function setContainer($container)
	{
		$this->container = $container;
	}

	/**
	 * Returns the type of alert.
	 *
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Sets the type of alert
	 *
	 * @param mixed $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Returns the type of alert.
	 *
	 * @return mixed
	 */
	public function getClass()
	{
		if ( $this->type == 'error')
		{
			return 'danger';
		}

		return $this->type;
	}

	/**
	 * Checks to see if the message is flashable
	 *
	 * @return boolean
	 */
	public function isFlashable()
	{
		return $this->flashable;
	}

	/**
	 * Sets whether the message is flashable or not.
	 *
	 * @param boolean $flashable
	 */
	public function setFlashable($flashable)
	{
		$this->flashable = $flashable;
	}

	/**
	 * Returns an array of extra attributes for the alert
	 *
	 * @return array|null
	 */
	public function getExtra()
	{
		return $this->extra;
	}

	/**
	 * Sets extra attributes for the alert.
	 *
	 * @param array $extra
	 */
	public function setExtra(array $extra = [])
	{
		$this->extra = $extra;
	}

}