<?php
require 'rb.php';


// require 'vendor/autoload.php';
// use RedBeanPHP\R as R;


// http://localhost/RedPHPBean/html/test.php
try{
    
    R::setup('mysql:host=localhost; dbname=taskmanager', 'root', ); 
    // For SQLite, use:
    // R::setup('sqlite:/tmp/dbfile.db');

    // Optional: Freeze the database schema in production
    // R::freeze(true);



    // CRUD Operations with RedBeanPHP

    // Create
    // Creating a new record in RedBeanPHP is straightforward. You create a new bean, set its properties, and store it in the database.

    // Create a new 'book' bean
    $book = R::dispense('book');
    $book->title = 'The Catcher in the Rye';
    $book->author = 'J.D. Salinger';
    $book->published = '1951';
    
    // Store the bean in the database
    $id = R::store($book);
    
    // TEST 
    print($book); 


    // Read
    // Reading records is equally simple. You can load a bean by its ID or find beans by certain criteria.
    
    // Load a bean by its ID
    $book = R::load('book', $id);
    
    // Find all books by a specific author
    $books = R::find('book', 'author = ?', ['J.D. Salinger']);

    // TEST 
    print($book);
    print($books); 

    // Update
    // Updating a record involves loading it, modifying its properties, and storing it again.
    
    // Load the bean
    $book = R::load('book', $id);
    
    // Update the properties
    $book->title = 'Nine Stories';
    $book->published = '1953';
    
    // Store the updated bean
    R::store($book);
        
    // TEST 
    print($book); 
    
    
    
    // Delete
    // Deleting a record is just as simple as other operations.
    
    // Load the bean
    $book = R::load('book', $id);
    
    // Delete the bean
    R::trash($book); 
    
    
    // Freezing the Database Schema
    // In a development environment, RedBeanPHP will automatically adjust the database schema to fit your objects. However, in a production environment, you want to prevent schema changes. This is where “freezing” comes in handy.
    
    // Freeze the database schema
    R::freeze(true);
    // When the schema is frozen, RedBeanPHP will throw an error if you try to make any modifications that require schema changes. This ensures the integrity and stability of your production database.
    

    // Conclusion
    // RedBeanPHP is a powerful yet simple ORM that can significantly simplify your database interactions. With its zero-configuration setup, automatic schema adjustments, and easy CRUD operations, it’s a great choice for developers looking to streamline their PHP applications. By using RedBeanPHP, you can focus more on writing your application logic and less on managing database queries and schema changes.
    
    // For more detailed documentation and advanced features, visit the official RedBeanPHP GitHub repository.

    // https://jewelhuq.medium.com/redbeanphp-a-simple-and-powerful-orm-for-php-7c0a13be4679















}catch(Exception $e){
    die($e); 
}




?> <!--- End ?PHP ---> 
<?php
