# jobs-example

This project is a simple application built with Symfony. It shows list of jobs by [Recruitis API](https://docs.recruitis.io/api/).

## Features

-   ✅ PHP 8.1
-   ✅ Symfony 6.4
-   ✅ Vite
-   ✅ Bootstrap 5.3
-   ✅ PHPStan
-   ✅ Laravel Pint (PHP Coding Standards Fixer)
-   ✅ Tests
-   ✅ Vue.js

## RecruitisApi

### Jobs

-   ✅ limit
-   ✅ page

### Workfields

-   ✅ implements cached response

## Testing

### JobControllerTest

Show list of jobs

-   mocking API response
-   assert response status code 200
-   there are no jobs to show

### WorkfieldControllerTest

Show list of workfields

-   mocking API response
-   assert response status code 200
-   there are 2 workfields to show

### WorkfieldApiTest

Mocking API response body and parse to class Job

-   mocking json body to response
-   mocking HTTP client for recruitis
-   parse data from array to data transfer objects
