# Laravel ACL Demo
This project is a simple Laravel 5.6 installation that makes use of an ACL in conjunction with a RESTful API locked down
with OAuth 2.0 (with Laravel Passport).

The application dummies the backend of an event booking system. There are 3 models:
- Venue - A physical building/location that can have several spaces within
- Space - A space within a venue that can host events
- Event - An event that takes place within a space

## Packages
Below are listed all the packages used in this app:

### Laravel Passport
This is included to implement OAuth 2.0 for the API. This allows access tokens to be create with password grants for a
user. This is a must as the ACL must be aware og which user is making the request.

**Project page:** [laravel/passport](https://github.com/laravel/passport)

### Laravel Permission
This is a very useful package that makes it easy to manage the ACL. It creates tables that allow for:
- Roles
- Permissions
- Assign permissions to roles
- Assign permissions to users
- Assign roles to users

In this example we only assign some permissions to roles and then those roles to users. But the flexibility is there to
add permissions directly to users if needed.

**Project page:** [spatie/laravel-permission](https://github.com/spatie/laravel-permission)

### Laravel Query Builder
This package allows us to make advanced queries to the API endpoints such as relations to include and filters. This
reduces the amount of API requests the client should have to make. It also allows for fine grained control which works
well with the ACL implementation that is used.

**Project page:** [spatie/laravel-query-builder](https://github.com/spatie/laravel-query-builder)

## Implementation
To begin with, there are CRUD controllers created for each model (Venue, Space and Event). A standard laravel policy is
created for each controller. The policy is checked at the top of each controller method and the corresponding policy
method is called to check if the user is authorised.

The call to the policy omits the action, this is because Laravel is clever enough to default to the calling methods
name. It goes one step further to map CRUD methods:
- `Controller::show() => Policy::view()`
- `Controller::store() => Policy::create()`
- `Controller::destroy() => Policy::delete()`

Within the policy the ACL package is then used to check permissions for each action.
