# TodoApi

This API was developed specifically for the TVNTY company 
as a test task.

In order to deploy and test the project locally, 
you need a GitHub account, any IDE or code editor installed, 
a program for creating and viewing databases and Postman as well. 

If you have all the above, follow these steps:

1. Open the console on the computer and clone the project using the git clone command.
2. Duplicate the file .env.example and name it .env. 
   There are already settings for connecting to the database (11 - 16 rows).
   If you already have a local database, 
   update the relevant data in the .env file (login and password).
3. Create a database called todo_api locally.
4. Go to the root folder of the project through the console 
   and execute the following commands:
    * `php artisan key:generate`
    * `php artisan migrate --seed`
    * `php artisan serve`
5. If for some reason you need to repopulate the database with random data, 
   run the following command in the console:
   * `php artisan migrate:fresh --seed`
6. After that, you can test existing API methods using the Postman.

Available API endpoints:

| Request type | Request URL  | Params                                      |
|-------------:|:------------:|:--------------------------------------------|
| GET          | /tasks       | -                                           |
| GET          | /task        | status, user_id                             |
| POST         | /task/add    | name, description, status, user_id          |
| PUT          | /task/update | task_id, name, description, status, user_id |
| DELETE       | /task/delete | task_id                                     |
| GET          | /users       | -                                           |
| POST         | /user/add    | name, email, password, role                 |
| PUT          | /user/update | user_id, name, email, password, role        |
| DELETE       | /user/delete | user_id                                     |

Available API params:

| Essence | Param       | Param type | Description                                                   |
|--------:|:-----------:|:-----------|:--------------------------------------------------------------|
| Task    | task_id     | Number     |                                                               |
| Task    | name        | String     | Must have at least 8 characters and not exceed 255 characters |
| Task    | description | String     | Must not exceed 255 characters                                |
| Task    | status      | Enum       | Possible statuses - NEW, WORK, PENDING, DONE                  |
| Task    | user_id     | Number     |                                                               |
| User    | user_id     | Number     |                                                               |
| User    | name        | String     | Must have at least 5 characters and not exceed 255 characters |
| User    | email       | String     | Must be valid email address                                   |
| User    | password    | String     | Must have at least 8 characters and not exceed 32 characters  |
| User    | role        | Enum       | Possible roles - USER, MODERATOR, ADMIN                       |
