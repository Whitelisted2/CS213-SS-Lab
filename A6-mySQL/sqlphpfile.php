<html>

<!--great for going back to main html file-->
<a href = "javascript:history.back()">Back to previous page</a>
<br> <br>

</html>
<?php
    $servername = 'localhost';
    $username = 'root';         // given username
    $password = '';             // no password
	$dbname = 'publications';   // database name
	
    // create connection
    $conn = new mysqli($servername, $username, $password);
	
	
    // verify existence of connection
    if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	
    // create database (if it doesn't already exist) and verify creation
    $sql = "CREATE DATABASE $dbname";
	if($conn->select_db($dbname) === FALSE)
	{
		if ($conn->query($sql) === TRUE)
		{
			//echo "Database created successfully";
		}
		else
		{
			echo "Error creating database: " . mysqli_error($conn) . "<br>";
		}
	}
	/*else{ // this was initial approach
		// drop and recreate database if it already exists
		$sql = "DROP DATABASE publications;";
		if ($conn->query($sql) === TRUE)
		{
			// echo "old database dropped successfully<br>";
		}
		$sql = "CREATE DATABASE publications;";
		// $sql .= "";
		if ($conn->query($sql) === TRUE)
		{
			// echo "Database re-created successfully<br>";
		}
		else
		{
			echo "Error re-creating database: " . mysqli_error($conn) . "<br>";
		}
	}*/
	$conn->close();
	
	// reopen and reverify connection, with the database this time
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
		die("Connection2 failed: " . $conn->connect_error);
	}
	
	// success messages have been commented out since they were used
	// just for debugging. Not necessary for the user
	// error messages have been kept in, to keep checking for errors
	// if tables authors and titles don't exist, then we create them.
	if ($result = $conn->query("SHOW TABLES LIKE 'authors'"))
	{
		if($result->num_rows == 1){
			//echo "Table authors exists";
		}
	}
	else{
		echo "Table does not exist";
		$sql = "CREATE TABLE authors(
		author VARCHAR(120) NOT NULL,
		publisher VARCHAR(30));";
		if ($conn->query($sql) === TRUE)
		{
			echo "table authors created successfully<br>";
		}
		else
		{
			echo "Error creating table authors: " . mysqli_error($conn);
		}
	}
	
	if ($result = $conn->query("SHOW TABLES LIKE 'titles'"))
	{
		if($result->num_rows == 1){
			//echo "Table titles exists";
		}
	}
	else{
		echo "Table does not exist";
		$sql = "CREATE TABLE titles(
		title VARCHAR(120) NOT NULL,
		author VARCHAR(120),
		year SMALLINT(6) );";
		if ($conn->query($sql) === TRUE)
		{
			echo "table titles created successfully<br>";
		}
		else
		{
			echo "Error creating table titles: " . mysqli_error($conn);
		}
	}
  
    // set variables in a way that they are allowed to be null.
    // when variable is not null, execute the corresponding function.
  
    @$display_authors_table = $_POST["disp_Authors"];
    @$display_titles_table = $_POST["disp_Titles"];
  
    @$add_authors_record = $_POST["add_Authors"];
    @$add_titles_record = $_POST["add_Titles"];
  
    @$delete_authors_record = $_POST["del_Authors"];
    @$delete_titles_record = $_POST["del_Titles"];
  
    @$update_year_for_title = $_POST["upd_Titles"];
    @$display_book = $_POST["disp_Book"];
    @$display_details_p = $_POST["disp_Details_pubwise"];
  
    // to display "authors" table (Answer to Q1A)
    if($display_authors_table)
	{
		echo "<h2>Table of Authors</h2>";
		$sql = "SELECT * FROM authors";
		$get_authors = mysqli_query($conn,$sql); // send query
		
		echo "<table border=1>"; // display as a table
		echo "<tr> <td>Author</td> <td>Publisher</td> </tr>";
		
		while($table_row = mysqli_fetch_assoc($get_authors)) // fetch rows as associative array
		{
			$author = $table_row["author"];
			$publisher = $table_row["publisher"];
			echo "<tr> <td>$author</td> <td>$publisher</td> </tr>";
		}
		
		echo "</table>";
		
		mysqli_free_result($get_authors); // free the associated memory
	}
	
	// to display "titles" table (Answer to Q1B)
	if($display_titles_table)
	{
		echo "<h2>Table of Titles</h2>";
		$sql = "SELECT * FROM titles";
		$get_authors = mysqli_query($conn,$sql); // send query
		
		echo "<table border = 1>"; // display as a table
		echo "<tr> <td>Title</td> <td>Author</td> <td>Year</td> </tr>";
		
		while($table_row = mysqli_fetch_assoc($get_authors)) // fetch rows as associative array
		{
			$title = $table_row["title"];
			$author = $table_row["author"];
			$year = $table_row["year"];
			echo "<tr> <td>$title</td> <td>$author</td> <td>$year</td> </tr>";
		}
		
		echo "</table>";
		
		mysqli_free_result($get_authors); // free the associated memory
	}
	
	// checking for varchar = is_string()
	// to add a record to authors table (Answer to Q2A)
	if($add_authors_record)
	{
		$author = $_POST['author1'];
		$publisher = $_POST['publisher1'];
		// author must not be null, so:
		// (no criteria such as primary key is given in question)
		if($author)
		{
			// Part of answer to Q7 (data type check):
			if(is_string($publisher) && is_string($author))
			{
				$sql = "INSERT INTO authors(author, publisher) 
				VALUES('$author','$publisher')";
				if(mysqli_query($conn,$sql))
					echo "New record added to table authors successfully!";
				else
					echo "Error: $sql";
			}
		}
		else{
			echo "Author field must not be blank!";
		}
	}
	
	// to add a record to titles table (Answer to Q2B)
	if($add_titles_record)
	{
		$title = $_POST['title2'];
		$author = $_POST['author2'];
		$year = $_POST['year2'];
		// title must not be null, so:
		// (no criteria such as primary key is given in question)
		if($title)
		{
			// Part of answer to Q7 (data type check):
			if(is_string($title) && is_string($author))
			{
				if(!(int)$year) //Part of answer to Q7 (data type check)
				{
					echo "Year must be integer!";
					return;
				}
				else{
					$sql = "INSERT INTO titles(title,author,year) 
					VALUES('$title','$author','$year')";
					if(mysqli_query($conn,$sql))
						echo "New record added to table authors successfully!";
					else
						echo "Error: $sql";
				}
			}
		}
		else{
			echo "Title field must not be blank!";
		}
	}	
	
	// to delete a record from authors table (Answer to Q3A)
	if($delete_authors_record)
	{
		// take author and delete all records with that author
		$author = $_POST['author_del'];
		$sql = "DELETE FROM authors WHERE author='$author'";
		if($author)
		{
			if(mysqli_query($conn,$sql))
				echo "Record deleted!!";
			else
				echo "Error during deletion: ".mysqli_error($conn);
		}
		else
			echo "author should not be blank...";
	}
	
	// to delete a record from titles table (Answer to Q3B)
	if($delete_titles_record)
	{
		// take title, delete books with the title.
		$title = $_POST['title_del'];
		$sql = "DELETE FROM titles WHERE title='$title'";
		if($title)
		{
			if(mysqli_query($conn,$sql))
				echo "Record deleted!!";
			else
				echo "Error during deletion: ".mysqli_error($conn);
		}
		else
			echo "title should not be blank...";
	}
	
	// To update year for books containing a title segment
	// (Answer to Q4)
	if($update_year_for_title)
	{
		// take title segment and year
		// update year for all titles containing the title segment
		$title = $_POST['title_upd'];
		$year = $_POST['year_upd'];
		if(!(int)$year) //Part of answer to Q7 (data type check)
		{
			echo "Enter only integer values in year!";
			return;
		}
		if($title && $year)
		{
			$sql = "UPDATE titles SET year='$year'
			WHERE title LIKE '%$title%'";
			if(mysqli_query($conn,$sql))
				echo "Record of year for the title was updated!!!";
			else
				echo "Error in updating: ".mysqli_error($conn);
		}
		else
			echo "Title or Year field was left blank!";
	}
	
	// to display books whose title contains a given string
	// (Answer to Q5)
	if($display_book)
	{
		$title = $_POST['book_title'];
		if($title)
		{
			echo "<h2>Book titles containing <i>$title</i></h2>";
			$sql = "SELECT title, author, year FROM titles 
			WHERE title LIKE '%$title%'";
			$records = mysqli_query($conn, $sql);
			echo "<table border=1>";
			echo "<tr> <td>Title</td> <td>Author</td> <td>Year</td> </tr>";
			while($row = mysqli_fetch_assoc($records))
			{
				$title = $row["title"];
				$author = $row["author"];
				$year = $row["year"];
				echo "<tr><td>$title</td><td>$author</td><td>$year</td></tr>";
			}
			echo"</table>";
			mysqli_free_result($records); // free the associated memory
		}
		else{
			echo "Book title field was left blank!";
		}
	}
	
	// to display book details from a given publisher
	// (Answer to Q6)
	if($display_details_p)
	{
		$publisher = $_POST['publisher_name'];
		if($publisher)
		{
			echo "<h2>Books and Authors of the Publishers whose names ";
			echo "contain <i>$publisher</i></h2>";
			$sql = "SELECT * 
			FROM authors t1, titles t2 
			WHERE t1.author = t2.author 
			  AND t1.publisher LIKE '%$publisher%'";
			$records = mysqli_query($conn, $sql);
			echo "<table border=1>";
			echo"<tr> <td>Title</td> <td>Author</td> <td>Year</td> </tr>";
			while($row = mysqli_fetch_assoc($records))
			{
				$title = $row["title"];
				$author = $row["author"];
				$year = $row["year"];
				echo "<tr> <td>$title</td> <td>$author</td> <td>$year</td> </tr>";
			}
			echo"</table>";
			mysqli_free_result($records); // free the associated memory
		}
		else
			echo "Publisher was left blank!";
	}
	
	$conn->close();
?>