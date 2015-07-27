<?php
   class MYDB extends SQLite3     				//First file makes connection to SQLite3 Database        
   {
      function __construct()
      {
          $this->open('DB/task.db');
      }
   }
?>