## Specification
- It should be possible to upload several files at the same time.
- It should be possible to enter a comment for each file.
- XSS protection should be integrated.
- It should be possible to limit the maximum file size (5MB).
- It should only be possible to upload images and PDF files.
- After the upload, the files should be checked for consistency.
- Errors should be displayed to the user.

##solution:
## Installation
Create a uploads folder (like next image) in the root with "images" and "pdf" subfolders.

<img width="156" alt="Screenshot 2023-02-03 at 4 18 30 PM" src="https://user-images.githubusercontent.com/2698275/216639553-6290f89f-8abe-41ff-9e91-1d6e290b01c9.png">


There is a sql file in the "database_file" folder. Import this into myslq and in the root folder "connection.php" file, write the connection data properly. File uploader will be visible in the root folder index.php file (eg. http://localhost/multiple_file_uploader)


## Validation

By dragging and dropping someone can put the file in the container of file uploader. If the files are not valid, validation errors will be showing by JS. By clicking submit, one can uplaod the files. After upload files are validated from the server and validation errors show accordingly. For XSS prevention "htmlpurifier" package is used. To prevent cross site request forgery added CSRF token. 

## Data storage
Image and PDF files are stored in the "Uploads" folder in the images and pdf folder. Image and pdf names with their mime type and comments are stored in the database, table name: files

Zip file is included with a Sql file. data is saved into the table "file".
