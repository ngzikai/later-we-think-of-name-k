<html>
<head>
    <title>Laterk</title>
</head>
<body>
 <form action="submit_newEvent.php" method="post">
  Event name:<br>
  <input type="text" name="event_name"><br>
   <input type="submit" value="Submit">
   <?php echo 'insert' . $_GET['msg'] ;?>
</form> 
</body>
</html>
