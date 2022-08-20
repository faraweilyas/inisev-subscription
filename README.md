## Inisev Subsription

Create a simple subscription platform(only RESTful APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)

## API

Here is the link to the [API Documentation](https://documenter.getpostman.com/view/4638046/VUqpsHVX).

After importing collection endeavor to change the variable host value in the collection settings

## Set Up Instructions

- Create DB called `inisev-subscription`
- Open a shell to run the server
- Open another shell tab to run the jobs
- Open another shell to run command scripts

# First Shell 

```bash
git clone https://github.com/faraweilyas/sshbunny.git
composer install
composer update
php -r "copy('.env.dev', '.env');"
php artisan migrate
php artisan serve
```

# Second Shell 

```bash
php artisan queue:work
```

# Third Shell 

```bash
php artisan mail:send
```
