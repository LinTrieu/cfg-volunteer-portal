# CodeFirst: Girls Volunteer Portal

Purpose: A platform to enable CFG instructors to log & record their volunteering hours

### Database Design & Schema 
Source: https://dbdiagram.io/d/5f57aa4488d052352cb669a9

### Local Development 
- [x] Laravel 8 application scaffold
- [x] Authentication scaffold
- [x] Set up local mySQL database
- [x] Makefile set up
- [x] Integrate social log in
- [ ] Include CSS Bootstrap and jQuery libraries
- [ ] Include additional front-end dependencies (ie. React) - TBC
- [ ] Heroku set up
- [ ] TravisCI set up
- [ ] Create test user login details


### Useful Make commands
- `make start`
- `make migrate-fresh ARGS="--seed"`


-------------------------------------

### How to set up & run application
 For guidance please refer to the file ref: '2.2.setup_instructions_to_run_application' 
 
1. Git clone repository,
2. Install PHP, mySQL, Composer, and GNU's Make software.  
2. Set up a local  mySQL database named `cfg_volunteers` (details below) 
3. Run the command `make migrate-seed` to run database migrations and seeders,
4. Compile CSS UI resources by running `npm install`, and build dev assets running `npm run dev` ,
5. Run `make start` to start the server. View application on your localhost.

See (Makefile)[https://github.com/LinTrieu/cfg-volunteer-portal/blob/master/Makefile] for a list of commands available in the application. 


#### Create a local mySQL database
1. Install the  mySQL client.

2. Run the mySQL client - `$ mysql -u root -p`
    - `-u` - user flag
    - `root` - database user login  
    - `-p` - password flag. You will be prompted to enter a password. Submit enter, with a blank password.

3. Create a local database the application can interact with: `CREATE DATABASE cfg_volunteers;` 
    - Run the query `SHOW DATABASES;`, to confirm your database has been created.

4. In the `.env` file (line 9-15), update the Database Connection config to match the database you configured locally. 
    - `DB_CONNECTION`, `DB_HOST`, `DB_PORT` - you should not have to update these,
    - `DB_DATABASE` - update with the name of your Database (e.g. `cfg_volunteers`),
    - `DB_USERNAME`, `DB_PASSWORD` - represent your personal mySQL user credentials.

5. Once your `.env` config is setup, run `make migrate` to verify your Database connection and run migrations.

-------------------------------------
### Technology Stack

- PHP 7.3.11
- Laravel Framework 8.9.0
- Composer, Dependency Manager
- mySQL Database 
- Eloquent, Database Object Relational Mapping (ORM)
- HTML, Blade templates
- CSS, Bootstrap library
- JavaScript, jQuery library
