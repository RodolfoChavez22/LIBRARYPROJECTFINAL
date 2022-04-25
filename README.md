# LIBRARYPROJECTFINAL

# COSC 3380 Library Database

## ACCOUNTS INFO IN GOOGLE DRIVE LINK

### Team 1 Members
- Hunter Jerry McPherson: [Hunter6058](https://github.com/Hunter6058)
- Rodolfo Jose Chavez: [RodolfoChavez22](https://github.com/RodolfoChavez22)
- Elinnoel S. Nuñez: [elinnunez](https://github.com/elinnunez)
- Justin Isaac Jose: [jjugsting](https://github.com/jjugstin)

## Project Description
The goal in building this project was to create an online library database management system with different functionalities such as item requests, item cancellations, create, read, update, and delete operations. There are 3 types of accounts, (users, staff, admin) that have different levels of accessibility. All users may request/hold items from the catalog database and there is also different maximum requests/orders and loan periods allowed for different types of users.

## File Description
For this project, our team used MYSQL for the database build, PHP for both server side scripting and front end design, AWS to host our website as well as XAMPP for the sql dump hosting.

## Live Site
http://18.207.206.17/library

## Installation Instructions for Windows localhost
- Download & Install [XAMPP](https://www.apachefriends.org/download.html)
- git clone project inside htdocs directory of XAMPP file location 
- Run XAMPP and click Start on Apache & MySQL
- Go to  http://127.0.0.1/phpmyadmin and create new database named library
- Import the sql dump file that's inside sql folder into the newly created database
- Open connect.php file and edit file line 3 as `$con=new mysqli('localhost', 'root', '', 'library');` and save.
- Open browser and enter directory: http://localhost/library/homepage.php
- Project should now run on local server

## Roles
- User
```
Maximum 3 current holds at any given time
Allowed 1 week loan periods
```
- Staff
```
Maximum 5 current holds at any given time
Allowed 2 week loan periods
```
- Admin
```
Maximum 5 current holds at any given time
Allowed 2 week loan periods
Can edit/add/delete items and users
Ability to accept/cancel user item requests
View reports and loan history of all users
```
- All
```
Rate of $3 added to balance owed per each day an item is past due date
```


## Triggers
- NOTIFICATIONS TRIGGER - We implemented a trigger in the reservation table that triggered an insert into the notification table every time a new reservation was made. The insert logged the reservation id, user id and the item id into the notifications table.
```
CREATE TRIGGER 'notification' 
AFTER INSERT ON 'reservation'
FOR EACH ROW INSERT into notifications VALUES(null, NEW.user, item)
```
- AUDIT LOG TRIGGER - Implemented user update/insert/delete triggers in the user table that would log types of actions into the audit table for display in admin dashboard.
```
EXAMPLE OF AFTER USER DELETE, OTHER TRIGGER FOLLOW THE SAME FORMAT 

CREATE TRIGGER `User_delete` AFTER UPDATE ON `user`
FOR EACH ROW IF NEW.Deleted_id = 1
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('user', NEW.User_id, 'DELETE', NOW());
END IF
```

- ITEM INSERT AND DELETE TRIGGERS- We implemented a set of insert and delete triggers that would be called if an item (book, journal, electronic, or disk) was inserted or deleted. Trigger would update their respective item table (like the book table for a book item) on the status of the item and update the user table of the user who's book it was by adding or decrementing their current orders total.
```
EXAMPLE OF BOOK DELETE TRIGGER OTHER TRIGGERS FOLLOW THE SAME FORMAT

CREATE TRIGGER `Item_Delete_Book` AFTER UPDATE ON `item`
 FOR EACH ROW IF New.Book_id IS NULL AND Old.Book_id is NOT NULL THEN
UPDATE book
SET book.Rental_status = book.Rental_status + 1
WHERE book.Book_id = old.Book_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = New.User_id;
END IF
```

- ADD LOAN TRIGGER - AFTER UPDATE Trigger created on the reservations table that would create a loan in loans table when requested items were approved by admin and the reservation is updated to "Loaned". Depending on the type of user account, the correct loan period due date would be set for the requesting user.
```
CREATE TRIGGER `Add_Loan` AFTER UPDATE ON `reservation`
 FOR EACH ROW INSERT INTO loan
(Item,User,Loan_date,Return_date)
VALUES
(New.Item,New.User,CURRENT_DATE,CURRENT_DATE + INTERVAL 14 DAY)
```
## Features

## Admin Panel
-  Dashboard holds reports and general statistics about the website along with a audit log listing any edits done to the items within the database
- User/Item (Book, Journal, Disk, Electronics) pages involve the use of create, read, update, delete operations, sorting and search filter functionality to display data of each of their respective table
- Loans page allows admins/librarians to confirm that a item has been returned and will update the user according to whether they turned in an item on time or not (get a fine if they dont) 
- Requests tab allows admins/librarians to accept or cancel book requests, if accepted it gets forwarded to the loans page, if it gets cancelled it gets put back in the catalog. 
- Restore page allows admins to recover any items that were marked for deletion.
- Reports page displays loan history with search filter functionality as well as catalog item statistics

## User Dashboard
- Dashboard holds important user information with the option to update some of that information that may change like email or password.
- Also allows user to see their Book history with information on the date it was requested, book status (if it was returned or still on loan, ect.) and book name.
- User is allowed to see books that are still being pending and click a checkbox to cancel the request.
- User also can check any notifications, which includes a message that shows to the user what item they have requested.
- Once a user has "debt" accumulated they can no longer request books until balance is 0.

## Catalog
- Users are able to search through the database by different item types (Books, Disks, Journals, Electronics) and filter through results by title, creator, or issn/isbn.
- Search results display images, name, creator, item type, publisher and availability of items to the user
- On clicking each row, modal popups display more information such as copies available, description and the reservation button for the user.
- Reservation functionality that allows only logged in users to request an item with item request limits.


## Home Page 
- Home page servers to promote books that are 'popular' by showing books who are running low on supply.
- Clicking on the book image presented allows user to read a description of the book and important book information as well as book supply.
- Home page allows signed-in users to reserve one of the promoted books straight from the home page.
- This page also has a search button option that will redirect users to the catalog and show queried result based on the title searched by the user.

## Signup/Login 
- Signup account validation in order to create secure accounts with needed security measures.
- User account validation is used in order to display the correct features depending on user type
- Passwords are stored inside the database in hashed form for security
- Security features are implemented to only allow non-deleted users access to login and request items.

## Project Tree Structure
```
library
├─ .htaccess
├─ about.php
├─ admin
│  ├─ adminpanel.php
│  ├─ astyle.css
│  ├─ book
│  │  ├─ add.php
│  │  ├─ delete.php
│  │  ├─ restore.php
│  │  └─ update.php
│  ├─ books.php
│  ├─ dashboard.php
│  ├─ disk
│  │  ├─ add.php
│  │  ├─ delete.php
│  │  ├─ restore.php
│  │  └─ update.php
│  ├─ disks.php
│  ├─ electronic
│  │  ├─ add.php
│  │  ├─ delete.php
│  │  ├─ restore.php
│  │  └─ update.php
│  ├─ electronics.php
│  ├─ journal
│  │  ├─ add.php
│  │  ├─ delete.php
│  │  ├─ restore.php
│  │  └─ update.php
│  ├─ journals.php
│  ├─ key
│  │  ├─ author.php
│  │  ├─ brand.php
│  │  ├─ genre.php
│  │  ├─ publisher.php
│  │  └─ type.php
│  ├─ loans.php
│  ├─ reports.php
│  ├─ request.php
│  ├─ requests
│  │  └─ requestchange.php
│  ├─ restore.php
│  ├─ user
│  │  ├─ add.php
│  │  ├─ delete.php
│  │  ├─ restore.php
│  │  └─ update.php
│  └─ users.php
├─ catalog.php
├─ connect.php
├─ find.php
├─ footer.php
├─ header.php
├─ homepage.php
├─ img
│  ├─ image.jpg
├─ index.php
├─ login.php
├─ logout.php
├─ modal.js
├─ README.md
├─ reserve.php
├─ signup.php
├─ sql
│  └─ library.sql
├─ style.css
├─ user
│  └─ userdashboard.php
└─ validate_signup.php
```
