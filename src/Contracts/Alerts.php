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

interface Alerts
{
	/**
	 * Creates a new alert instance and adds it to the bag.
	 *
	 * @param $message
	 * @param $type
	 * @param string $container
	 * @param bool $flashable
	 * @param array $extras
	 * @return $this
	 */
	public function alert($message, $type, $container = 'default', $flashable = true, $extras = []);

	/**
	 * Returns all items that belong the the given array
	 * of containers.
	 *
	 * @param array $container
	 * @return static
	 */
	public function whereInContainer($container);

	/**
	 * Returns all items that do not belong the the
	 * given array of containers.
	 *
	 * @param array $container
	 * @return static
	 */
	public function whereNotInContainer($container);

	/**
	 * Returns all items that have the given types.
	 *
	 * @param array $type
	 * @return static
	 */
	public function whereType($type);

	/**
	 * Returns all items that do not have the given types.
	 *
	 * @param array $type
	 * @return static
	 */
	public function whereNotType($type);

	/**
	 * Returns the name of the session prefix
	 *
	 * @return string
	 */
	public function getSessionName();

	/**
	 * Sets the name of the session prefix
	 *
	 * @param string $sessionName
	 */
	public function setSessionName($sessionName);

	/**
	 * Returns instance of the  SessionStore
	 *
	 * @return SessionStore
	 */
	public function getSession();

	/**
	 * Sets instance of the SessionStore
	 *
	 * @param SessionStore $session
	 */
	public function setSession(SessionStore $session);
}