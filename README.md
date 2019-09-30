# NEWWAY FILE MANAGER
[![Gitter](https://badges.gitter.im/newwayfilemanager/community.svg)](https://gitter.im/newwayfilemanager/community?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)]()   [<img src="https://upload.wikimedia.org/wikipedia/commons/0/06/Facebook.svg" width="80">](https://www.facebook.com/newwayfilemanager)


# Need help? Have a suggestion? Join with us in gitter
https://gitter.im/newwayfilemanager/community#


Newway is a file manager for servers written with PHP. To install it, just download this repo and place the folder in your root and access it by `https://yourwebsitename/foldername`. You will be asked to set up an email and password to access the file manager. This application doesn't require a database. Instead, it uses a flat files as its database, which will be generated and placed outside your root directory after the completion of setup. Other things in this file manager are pretty self explantory.

## Installation
Newway uses the presence of the `users.json` file to detect whether an email ID and password has been registered. If you forget the email ID or password registered for Newway, the only way to reset it is to delete the `users.json` file (thus deleting the existing registered information). After doing so, you'll be able to register a new email ID and password for Newway.

## Screenshots from Newway

## Main UI (List View)

![Screenshot_2019-09-29_20-57-28](https://user-images.githubusercontent.com/18109258/65834852-c9653580-e2fc-11e9-964c-81b898a33b11.png)

## Main UI (Grid View)
![Screenshot_2019-09-29_20-56-55](https://user-images.githubusercontent.com/18109258/65834853-c9653580-e2fc-11e9-8466-09c4b28bb883.png)

# Like to contribute?
I appreciate your interest to contributing to newway, please follow the below steps
- The entire codebase is developed with tdd(test driven development), and all paths in api/all_classes.php are covered in it
- Newway file manager uses codeception testing framework for running tests (download from here -> https://codeception.com/) 
- After downloading, go to newway file manger directory and enter `php /path/to/codeception/binary run unit` in terminal, it will run the tests and it will pass all the tests (it should, unless some file tests may fail in some operating systems)
- Write the test and then make your change
- Run the tests again if it passes, push it to your branch
- send the pull request.
- if the test fail after making your change it indicates it broke some part of the working application
- so in that case you need to refactor the code and make sure the tests always pass
