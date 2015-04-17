# Alerts for Laravel 5

Package for managing alerts (messages) in your Laravel 5 application

### Installation

First things first, let's pull the package in from composer

```
composer require dberry37388/laravel5-alerts
```

### Integrating with Laravel

Open up ```app.php``` and add the following to the providers array

```
"Dberry37388\Alerts\AlertsServiceProvider",
```

Next, let's add the facade. This will let you do things like ```Alerts::getErrors()```. We'll add this to the
```aliases``` array.

```
'Alerts'    => 'Dberry37388\Alerts\Facades\Alerts'
```

### Published the Config
You can publish the default config to your ```app/config``` directory by running the following command:

```
php artisan vendor:publish --provider="Dberry37388\Alerts\AlertsServiceProvider" --tag=config
```

### Usage

Adding a new alert. In this example, we are adding an "info" alert. You can substitute "info" with any type that you need.

```
Alerts::error('my message');
Alerts::alert('info', 'Your Message Here');
```

Adding an alert to a container other than the default:

```
Alerts::error('My message', 'pnotify');
Alerts::alert('errors', 'My message here", "pnotify");
```

Adding an alert with "extra" attributes. Extra attributes can be used however you want. For example if you want to pass
a title, an icon class, etc.

```
Alerts::alert('info', 'My message here', null, ['icon' => 'fa fa-info', 'title' => 'Welcome!', 'timeout' => 4000]);
```

Retrieving all alerts.

```
$alerts = Alerts::all();
```

Retrieving all alerts of a specific type.
You simple prefix the "type" with get, for example to retrive all error message: or use the full syntax.

```
$errors = Alerts::getError();
$errors = Alerts::whereType('errors');
```

Retrieving all alerts of a specific type in a specific container, just pass the container as an argument.

```
$alerts = Alerts::getError('pnotify');
$errors = Alerts::whereType('errors')->whereInContainer('pnotify');
```

You can also retrieve all alerts that are **not** of a specific type.

```
$errors = Alerts::notError('errors');
$errors = Alerts::whereNotType('errors');
```

### Containers
Containers can be used to group notifications. For example if you want to pass form validation errors, you could have
a "validation" container, or if you want certain notifications to display using a javascript growl type notification,
you could group those in a "notifications" container.

Retrieving all alerts in a specific container, you just prefix the container name with "where":

```
$alerts = Alerts::whereErrors();
$alerts = Alerts::whereInContainer('errors');
```

To retrieve all alerts in a specific container with a specific type, just pass the type as an argument.

```
$alerts = Alerts::whereNotification('info');
$alerts = Alerts::whereInContainer('errors')->whereType('info');
```
