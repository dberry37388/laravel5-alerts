<?php namespace Dberry37388\Alerts;

use Dberry37388\Support\ServiceProvider;

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

class AlertsServiceProvider extends ServiceProvider
{

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		$this->package('dberry37388/alerts');
	}


	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		$this->registerSessionStore();
		$this->registerAlerts();
	}


	/**
	 * Registers the Alerts SessionStore with the IoC and aliases the
	 * interface to our SessionStore class.
	 */
	protected function registerSessionStore()
	{
		$this->app->singleton('dberry37388.alerts.sessionStore', function($app)
		{
			return new SessionStore($app['session.store']);
		});

		$this->app->alias('Dberry37388\Alerts\Contracts\SessionStore', 'Dberry37388\Alerts\SessionStore');
	}


	/**
	 * Registers our Alerts collection with the IoC
	 */
	protected function registerAlerts()
	{
		$this->app->singleton('dberry37388.alerts', function($app)
		{
			$sessionName = config('dberry37388-alerts.session_name');

			$items = $app['session']->pull($sessionName);

			$alerts = new Alerts($items);

			$alerts->setSession($app['dberry37388.alerts.sessionStore']);
			$alerts->setSessionName($sessionName);

			return $alerts;
		});

		$this->app->alias('Dberry37388\Alerts\Contracts\Alerts', 'Dberry37388\Alerts\Alerts');
	}
}
