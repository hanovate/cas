CAS client for Laravel 7
========================

This is a fork of subfission/cas updated to utilize Laravel's session management methods.

Refer to subfission/cas documentation for more details.
This includes installation and usage procedures which were tested on Laravel 7.6.1 as of 2020-04-15.

Simple CAS Authentication for Laravel 7.x.


INSTALLATION
------------

## 1. Install the package inside your project root folder:

```
$ composer require hanovate/cas
```

## 2. Add the following two lines to your ./app/Http/Kernel.php

```
    protected $routeMiddleware = [
        ...
        'cas.auth' => \Hanovate\Cas\Middleware\CASAuth::class,
        'cas.guest' => \Hanovate\Cas\Middleware\RedirectCASAuthenticated::class,
        ...
    }
```

## 3. Add the following environment parameters in your ./.env

```
CAS_HOSTNAME=login.myschool.edu
CAS_REAL_HOSTS=login.myschool.edu
CAS_LOGOUT_URL=https://login.myschool.edu/cas/logout
CAS_REDIRECT_PATH=https://myapp.myschool.edu/main-for-logged-in-user
CAS_CONTROL_SESSIONS=false
CAS_ENABLE_SAML=true
CAS_VERSION=3.0
```

CAS_DEBUG, CAS_VERBOSE_ERRORS can be set to true if you want to see more detailed error message.

CAS_VERSION should be set to the CAS protocol version, not the CAS server version.

CAS_REDIRECT_PATH is the default address to go after the user is authenticated on the CAS server.


USAGE
-----

In your route file (e.g. ./routes/web.php), the web middleware cas.auth can be used for the simple authentication.

```
...

Route::get('/home-guest',function() {
    if (cas()->isAuthenticated())
        echo 'authenticated<br>'; 
    else
        echo 'not authenticated<br>';
    echo '<a href="/main">login</a>';
});

...

Route::middleware(['cas.auth'])->group(function() {

    Route::get('/main-for-logged-in-user', function() {
        if (cas()->isAuthenticated())
            echo 'authenticated<br>';
        else
            echo 'not authenticated<br>'; // this line won't be reached as this route is inside the middleware
        echo 'user: '.cas()->user().'<br>';
        echo '<a href="/auth/logout">logout</a>';
    });

    Route::get('/auth/logout',function() {
        return cas()->logout(null,'https://myapp.myschool.edu/home-guest');

});
...
```


LICENSE
-------
The MIT License (MIT)

Copyright (c) 2017 Zach Jetson

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
