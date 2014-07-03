Web-Service-Boilerplate
=======================

A very simple web service boilerplate.

Requests
----

All requests should include an action parameter. Other parameters depend upon the request method.

Response
----

Response is in JSON format.

```sh
    {"result":{"status":true,"message":"Application is healthy!"}}
```

How-To
----

 * Create a new php file in services folder.
 * Write you custom method.
 * Register this method so it is callable.

 ```sh
 global $app;
 $app->registerService( 'test' );
 ```

 * All custom methods that are callable via API, must use response object.

 ```sh
 $r = responseObject();
 $r->response['status'] = APP_OK;
 $r->response['message'] = 'Application is healthy!';
 ```
