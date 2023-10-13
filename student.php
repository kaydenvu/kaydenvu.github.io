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

      $CNo = $_POST['CNo'];

      $query = "Select Sections.SNo, Sections.Classroom, Sections.MeetingDays, Sections.StartTime, Sections.EndTime, count(Grades.SNo) As 'Count'
                From ((Sections 
                Inner Join Courses On Courses.CNo = Sections.CNo)
                Inner Join Grades On Grades.SNo = Sections.SNo)
                Where Courses.CNo = $CNo
                Group By Sections.SNo;";
      $result = $link->query($query);
      $nor = $result->num_rows;
    ?>

    <table class="table">
      <h2>Current Classes</h2>
      <tr>
        <th>Section</th>
        <th>Classroom</th>
        <th>Meeting</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Students Enrolled</th>
      </tr>
      <?php for ($i=0; $i < $nor; $i++) { 
        $row = $result->fetch_assoc(); ?>
        <tr>
          <td><?php echo $row['SNo']; ?></td>
          <td><?php echo $row['Classroom']; ?></td>
          <td><?php echo $row['MeetingDays']; ?></td>
          <td><?php echo $row['StartTime']; ?></td>
          <td><?php echo $row['EndTime']; ?></td>
          <td><?php echo $row['Count']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php
      $result->free_result();
      $link->close();
    ?>
  </body>
</html>
