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

interface SessionStore
{
	/**
	 * Flash a message to the session.
	 *
	 * @param $name
	 * @param $data
	 */
	public function flash($name, $data);

}