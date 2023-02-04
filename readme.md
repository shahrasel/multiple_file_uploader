## Installation
Create a uploads folder (like next image) in the root with "images" and "pdf" subfolders.

<img width="156" alt="Screenshot 2023-02-03 at 4 18 30 PM" src="https://user-images.githubusercontent.com/2698275/216639553-6290f89f-8abe-41ff-9e91-1d6e290b01c9.png">


There is a sql file in the "database_file" folder. Import this into myslq and in the root folder "connection.php" file, write the connection data properly. File uploader will be visible in the root folder index.php file (eg. http://localhost/multiple_file_uploader)


## Validation

By drag and drop someone can put the file in the container file uploader. If the file is not valid validation errors will be showing by JS validation. By clicking subimt, one can uplaod the files. After upload files are validated from the server and validation error shows accordingly. For XSS validation "htmlpurifier" package in used. 

## Data storage
Image and PDF files are stored in the "Uploads" folder in the images and pdf folder. Image and pdf names with their mime type and comments are saved in the database, table name: files

Zip file is included with a Sql file. data is saved into the table "file".
