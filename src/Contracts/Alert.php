<?php

namespace Dberry37388\Alerts\Contracts;

/**
 * Part of the Alerts package.
 *
 * Licensed under the MIT License
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Alerts
 * @version    1.0.0
 * @author     Daniel Berry
 * @license    MIT License
 * @copyright  (c) 2015, Daniel Berry
 * @link       https://github.com/dberry37388/laravel5-alerts
 */

interface Alert
{

	/**
	 * Returns the Alert's message
	 *
	 * @return string
	 */
	public function getMessage();

	/**
	 * Set's the alert's message
	 *
	 * @param string $message
	 */
	public function setMessage($message);

	/**
	 * Return the container that the alert belongs to
	 *
	 * @return string
	 */
	public function getContainer();

	/**
	 * Sets the container that the alert belongs to
	 *
	 * @param string $container
	 */
	public function setContainer($container);

	/**
	 * Returns the type of alert.
	 *
	 * @return mixed
	 */
	public function getType();

	/**
	 * Sets the type of alert
	 *
	 * @param mixed $type
	 */
	public function setType($type);

	/**
	 * Checks to see if the message is flashable
	 *
	 * @return boolean
	 */
	public function isFlashable();

	/**
	 * Sets whether the message is flashable or not.
	 *
	 * @param boolean $flashable
	 */
	public function setFlashable($flashable);

	/**
	 * Returns an array of extra attributes for the alert
	 *
	 * @return array|null
	 */
	public function getExtra();

	/**
	 * Sets extra attributes for the alert.
	 *
	 * @param array $extra
	 */
	public function setExtra(array $extra = []);
}