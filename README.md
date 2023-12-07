## This is task by Vladimer Keinashvili

First of all to get started you will need client which accepts json post requests.
Personally I am using postman, I have included collection json file in project's
directory. 
Named (```palitra_task.postman_collection.json```)

Using the application:
- You will need to run migration with command ```php artisan migrate```
- You need to sign in to the application with api/login endpoint or register with api/register endpoint.
- After authentication, you will need to copy the access token.
- You will need to paste it in collection's request tab called Authentication you should select Bearer Token in selector.
- And you are good to go.
