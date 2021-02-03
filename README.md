# <span style="color:cyan">**Armada | Market Indicies**</span>

## <span style="color:gold">**[ BACKEND ]**</span>

Creating new Symfony Project with: <br>
&nbsp;&nbsp;&nbsp;`symfony new server` <br>
_Symfony binaries have to be installed to use command symfony_ <br>

---

<br>

Install necessary packages <br>
&nbsp;&nbsp;&nbsp;`cd server` and then <br>
&nbsp;&nbsp;&nbsp;`composer require make orm security firebase/php-jwt doctrine/annotations` <br>

---

<br>

Make sure to move the data directory (the directory that contain our json files) into server directory (the project directory that was created with symfony) <br>

---

<br>

Create our User Entity<br>
&nbsp;&nbsp;&nbsp;`php bin/console make:user`<br>
with all options being the default <br>
Then:<br>

1. Modify DATABASE_URL inside .env
2. Create the database: `php bin/console doctrine:database:create`
3. Make migration: `php bin/console make:migration`
4. Commit migration: `bin/console doctrine:migrations:migrate`
   <br>

---

<br>

## Controllers & Functionality

1. Create AuthController.php `bin/console make:controller AuthController`

2. Change encryption algorithm to bcryp inside security.yaml (Just a prefference).

3. Added Registration functionality @route **/auth/register**

4. Add our JWT Secretphrase as parameter in services.yaml.

5. Added Login Functionality @route **/auth/login**

6. `mkdir src/Security` and then create our JwTAuthenticator.php

7. Modify our pattern in security.yaml and also add our new authenticator as guard for that pattern.

8. Create our MarketController.php `php bin/console make:controller MarketController`

9. Create paths and functionality of our market API.
