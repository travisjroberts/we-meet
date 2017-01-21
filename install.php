<?php
    // Open the database (will create the file if it doesn't exist)
    $database = new SQLite3("database.db"); 

    // Begin Create
    $query_string = "CREATE TABLE IF NOT EXISTS availability (
                        time_stamp REAL NOT NULL,
                        year INTEGER NOT NULL,
                        week INTEGER NOT NULL,
                        day INTEGER NOT NULL,
                        hour INTEGER NOT NULL,
                        minutes INTEGER NOT NULL,
                        user_id INTEGER NOT NULL,
                        PRIMARY KEY (year, week, day, hour, minutes, user_id)
                      );";

    $database->query($query_string);
    echo "Database created";
    // End Create


    // Close the database
    $database->close();
?>
