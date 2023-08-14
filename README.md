# Statview Satellite
The package that setups the communication channel for Statview. More information at https://statview.app. 

## Installation
### Composer require
```bash
composer require statview/satellite
```

### Publishing vendor
```bash
php artisan vendor:publish --tag="statview-config"
```

### Adding environment variables
You can get the variable data during the project setup at Statview.
```dotenv
STATVIEW_API_KEY=
STATVIEW_PROJECT_ID=
```

## Usage
### Provide data for widgets
You can register your widgets by adding it to a Service Provider.
```php
use Statview\Satellite\Statview;

public function boot()
{
    Statview::registerWidgets(function () {
        return [
            Widget::make('total_users')
                ->title('Total users')
                ->value(User::count())
                ->description('All the users since start of the project'),

            Widget::make('total_teams')
                ->title('Total teams')
                ->value(Team::count()),

            Widget::make('total_projects')
                ->title('Total projects')
                ->value(Project::count()),
        ];
    });
}
```

### Post messages to your timeline
Posting messages to your timeline is very easy. The Satellite package has everything build-in to start posting to your timeline.

```php
use Statview\Satellite\Statview;

Statview::postToTimeline(
    title: 'Houston, we have a problem',
    body: 'There is a problem with renewing subscriptions.',
    type: 'danger' // Defaults to info,
    icon: '🚨' // Expects emoji string - defaults to 📣,   
);
```

## Support
Send us and email at support[at]statview.app. We are happy to help.
