## Installation
Please create a uploads folder (like next image) in the root with "images" and "pdf" subfolders.

<img width="156" alt="Screenshot 2023-02-03 at 4 18 30 PM" src="https://user-images.githubusercontent.com/2698275/216639553-6290f89f-8abe-41ff-9e91-1d6e290b01c9.png">


Please import the database found in the folder name "database_file" and in the root folder "connection.php" file insert the connection data properly. File uploader will be shown in the root folder index.php file.


## Validation

By drag and drop someone can put the file in the container. If the file is not valid validation errors will be showing by JS validation. By clicking subimt, one can uplaod the files. After upload files are validated from the server and validation error shows accordingly. 

## Data storage
Image and PDF files are stored in the "Uploads" folder in the images and pdf folder. Image and pdf names with their mime type and comments are saved in the database, table name: files

Zip file is included with a Sql file. data is saved into the table "file".
