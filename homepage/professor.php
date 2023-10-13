<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="style.css" />
  <style>
    th, td {
      background: rgb(0,0,0,0.6);
      color: #bdff91;
      border: 1px solid black;
      padding: 10px;
    }
    
    table {
      display: flex;
      justify-content: center;
      height: 100vh;
    }
    
    h2 {
      color: #bdff91;
      text-align: center;
    }
</style>
  </head>
  <body>
    <?php
      // username and password need to be replaced by your username and password
      // dbname is the same as your username
      
      $link = mysqli_connect('mariadb', 'cs332t21', 'Ag525YP2','cs332t21');
      if (!$link) {
        echo "<p>Mest Up :(</p>";
        die('Could not connect: ' . mysql_error());
      }

      $SSN = $_POST['SSN'];

      $query = "Select Professors.Name, Courses.Title, Sections.Classroom, Sections.MeetingDays, Sections.StartTime, Sections.EndTime
                From ((Sections
                Inner Join Professors On Professors.SSN = Sections.SSN)
                Inner Join Courses On Courses.CNo = Sections.CNo)
                Where Sections.SSN = $SSN;";
      $result = $link->query($query);
      $nor = $result->num_rows;
    ?>

    <table class="table">
      <h2>Current Classes</h2>
      <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Classroom</th>
        <th>Meeting</th>
        <th>Start Time</th>
        <th>End Time</th>
      </tr>
      <?php for ($i=0; $i < $nor; $i++) { 
        $row = $result->fetch_assoc(); ?>
        <tr>
          <td><?php echo $row['Name']; ?></td>
          <td><?php echo $row['Title']; ?></td>
          <td><?php echo $row['Classroom']; ?></td>
          <td><?php echo $row['MeetingDays']; ?></td>
          <td><?php echo $row['StartTime']; ?></td>
          <td><?php echo $row['EndTime']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php
      $result->free_result();
      $link->close();
    ?>
</body>
</html>
