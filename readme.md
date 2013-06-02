### Deployment

Setup Heroku

```
heroku apps:create -b https://github.com/heroku/heroku-buildpack-php.git --region eu
git push heroku master

heroku config:add BUILDPACK_URL=git://github.com/ddollar/heroku-buildpack-multi.git
heroku addons:add cleardb:ignite
heroku addons:add sendgrid:starter

heroku apps:rename project-name

heroku ps:scale web=1
heroku open
```

Deploy the app from the master branch.

```
git checkout master
git push heroku master
```

### Laravel PHP Framework

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

### Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)