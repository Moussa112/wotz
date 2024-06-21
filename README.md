# Recipes
I am assuming you can initialize/setup an application so I am skipping this part.
You can use sail or the local dev server, whatever your preference is.
For the fronted I use the tailwind cdn so an internet connection is kinda required.
I did not put a lot of effort into the frontend but just a basic layout because I don't like ugly looking things.

The test is not 100% completed there are 2 functionalities missing:
1. being able to filter on multiple categories via the website (the front end is not prepared for this, it is possible via the api)
2. the interactive ingredients on the view page 

## API
For the api I used a simple query bus to seperate the responsibility of handling requests (queries) from the logic that processes the queries (SRP).
It has some more advantages for example for scalability and centralized error handling.
### Search recipes.
Try it in your browser or in your favorite api client (postman).
> /api/recipes?filter[category.name]=category1,category2&filter[search]=random%20search%20term
## Website
### Overview page
You can view all the recipes in a paginated list on the homescreen with a functionality to live search by recipe title and ingredient name, with a live category filter and sharable urls.
> /?category=category1&search=random%20search%20term
### Detail page
You can view a detailed recipe with 4 more random recipe suggestions within the same category, the current recipe is always excluded. 
These 4 random recipes are cached for 24h.

We don't want to expose database id's into limbo so always make urls sluggable. This also has some boring SEO advantages. 
> /recipe/{slug}
## Testing
I only provided simple tests for the api since I don't have a lot of experience in front end/end to end testing.
I've only used Cypress in the past but selenium is what the cool kids use nowadays and I didnt want to put time into setting of these tests since I've had my hands full with using Livewire for the first time.
### Prepare test db
Ensure you have a test database configured in your .env.testing file and run migrations to set up the schema:
```
APP_ENV=testing
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
> php artisan migrate --env=testing
### Run tests
> php artisan test
