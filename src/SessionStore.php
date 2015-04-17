<?php

namespace Dberry37388\Alerts;

use Dberry37388\Alerts\Contracts\SessionStore as SessionStoreContract;
use Illuminate\Session\Store;

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

class SessionStore implements SessionStoreContract
{

	/**
	 * Instance of the Illuminate Session Store
	 *
	 * @var Store
	 */
	private $session;

	/**
	 * Creates a new instance of our alerts session store.
	 *
	 * @param Store $session
	 */
	function __construct(Store $session)
	{
		$this->session = $session;
	}

	/**
	 * {#inheritDoc}
	 */
	public function flash($name, $data)
	{
		$this->session->flash($name, $data);
	}
}
