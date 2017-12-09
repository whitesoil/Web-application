<!DOCTYPE html>

<html>
  <head>
  <meta charset = "utf-8" />
  </head>
  <body>

   <form action ="/sql/sql.php" method = "get">

     <div>
       DB_Name:
       <input type="text" name="name"/>
       Query:
       <input type="text" name="query"/>
     </div>
     <div id="submitbutton">
       <!-- create submit button here -->
       <input type="submit" value="sendquery"/>
     </div>
   </form>

     <?php
        $db_name = $_GET["name"];
        $query = $_GET["query"];
        $db = new PDO("mysql:dbname=$db_name","root","root");
        $rows = $db->query("$query");
      ?>
      <ul>
        <?php
         foreach($rows as $row){
         ?>
         <li>
            <?php
            $j = count($row)/2;
            for($i=0;$i<$j;$i++){
              print $row["$i"]." ";
            }?>
         </li>
         <?php
         }
          ?>
      </ul>

   </body>
</html>
