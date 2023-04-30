<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<h1 align="center">Dynamic Survey Form API</h1>
<hr>

### Requirements

<table>
    <thead>
        <tr>
            <th>Package</th>
            <th>Version</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="https://laravel.com/docs/10.x/readme" rel="nofollow">Laravel</a></td>
            <td>V10.8+</td>
        </tr>
        <tr>
            <td><a href="https://getcomposer.org/" rel="nofollow">Composer</a></td>
            <td>V2.2.6+</td>
        </tr>
        <tr>
            <td><a href="https://www.php.net/" rel="nofollow">Php</a></td>
            <td>V8.1+</td>
        </tr>
    </tbody>
</table>

<hr>

### Quick Installation

    > git clone https://github.com/Htet-Lin-Aung/laravel-practical-test
    > cd laravel-practical-test
    > composer install or composer update
    > cp .env.example .env
    > Set up .env file
    > php artisan key:generate
    > php artisan migrate
    > php artisan serve
    http://127.0.0.1:8000
<hr>

#### Custom Form

You can create custom forms for surveys and questionnaires!

#### Backend APIs
- App\Http\Controllers\API\AuthController
  - include register,login,logout features
- App\Http\Controllers\API\SurveyController
  - include dynamic form inputs by default input types(text, date picker, number).

#### Public Form
- resources\view\home
  - Sample dynamic form blade

<hr>

#### Include Features
- API Routes and Controllers
- API Eloquent Resources
- API Auth with Sanctum
- Override API Error Handling and Status Codes
- API Versioning

#### Debugging Errors
- Try-Catch and Laravel Exceptions are used.

<hr>

### Sample Api Requests
- For Register <br>
    {
        "headers": {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        "name": "User Name",
        "email": "test@gmail.com",
        "password": "12345678",
        "confirm_password": "12345678"
    }

- For Login <br>
    {
        "headers": {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        "email": "test@gmail.com",
        "password": "12345678"
    }
    
- For Logout <br>
    {
        "headers": {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": "Bearer 3|L2iHvnUcrUioRk0w6OR7E4njTyWi5VhZpbjRG4xT"
        },
    }
- For Survey Post <br>
    {   "headers": {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": "Bearer 3|L2iHvnUcrUioRk0w6OR7E4njTyWi5VhZpbjRG4xT"
        },
        "surveys": [
            {
                "code": "name",
                "answer": "Name"
            },
            {
                "code": "phone_number",
                "answer": "No"
            },
            {
                "code": "dob",
                "answer": "2022-03-05"
            }
        ],
        "form_id": 1
    }
