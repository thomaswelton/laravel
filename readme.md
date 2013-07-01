## Laravel Bootstrap
[![Build Status](https://travis-ci.org/thomaswelton/laravel.png)](https://travis-ci.org/thomaswelton/laravel)
[![Dependency Status](https://david-dm.org/thomaswelton/laravel.png)](https://david-dm.org/thomaswelton/laravel)

<img src="icon.png" align="right" height=150>

In order to deploy this project to your own server you'll need

* [Composer](http://getcomposer.org/doc/00-intro.md#globally)
* [Heroku Toolbelt](https://toolbelt.herokuapp.com/)

Once these requirements are met the project can be deployed using the following commands

### Setup

```
composer create-project thomaswelton/laravel project-name master-dev
cd project-name
git init
git add .
git commit -m "Installed Laravel bootstrap"
```

### Deployment

```
heroku apps:create -b https://github.com/heroku/heroku-buildpack-php.git --region eu
heroku config:add BUILDPACK_URL=git://github.com/ddollar/heroku-buildpack-multi.git
heroku addons:add cleardb:ignite
heroku addons:add sendgrid:starter

heroku apps:rename project-name

git push heroku master
heroku ps:scale web=1
heroku open
```

### Contributing

To work with this project locally you will need to install

* [Node](http://nodejs.org)
* [Ruby](http://www.ruby-lang.org/en/downloads/)
* [Grunt CLI](http://gruntjs.com/getting-started#installing-the-cli)
* [Bundler](http://gembundler.com/)

You can then install the dependencies and compile the project.

```
npm install
grunt
```

### Laravel PHP Framework

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

### Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
