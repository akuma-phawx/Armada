   # <span style="color:cyan">**Armada**</span>

<br>

<br>
<br>

## **[ Purpose and Technologies ]**

---

Main purpose of this web app is to offer its users the ability to constantly check the prices in a specific market(depending the id that was selected) so they can estimate the value of their stocks for example.

Vue (with Vuex) has been used for the frontend, PhpSymfony 5 for the backend, with JWT for the authentication tool. The application has many security holes, it has not been customized (e.g. css, responsiveness) and it has a loot of room for improvement, but still it fills its main purpose.

To run the app:

1. `cd client` and `npm run serve`
2. On another terminal `cd server` and `symfony server:start` OR `php -S localhost:8000 -t public`
3. I personally used MySQL since i had XAMPP already installed. Make sure you have it running!

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

---

## <span style="color:gold">**[ FRONTEND ]**</span>

Create new Vue Project with `vue create client`, modify selections, include **Router** and **Vuex** - remove **ESLint**, and use **Vue2**.
<br>

---

<br>

`cd client` to move into our new working directory and `npm i axios` which we gonna use later on for our requests to the server.<br>

---

<br>

Create our Components (Home, Market, MarketDropdown, MarketContent, Login, Register), modify our routes (in file src/router/index.js), install BootstrapVue (import in src/main.js).

<br>

---

<br>

Making our API calls from store.
