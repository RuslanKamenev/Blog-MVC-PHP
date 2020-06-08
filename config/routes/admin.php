<?php

App::addRoute('/', 'HomeController@index');
App::addRoute('/posts', 'PostsController@index');
App::addRoute('/post/deleted', 'PostController@deleted');
App::addRoute('/post/add', 'PostController@add');
App::addRoute('/edit', 'PostController@edit');
App::addRoute('/post', 'PostController@index');
App::addRoute('/users', 'UsersController@index');
App::addRoute('/user/add', 'UsersController@add');
App::addRoute('/user', 'UsersController@edit');


