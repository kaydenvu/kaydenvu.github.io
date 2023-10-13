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
        filter: drop-shadow(8px 8px 3px black);
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
      $SNo = $_POST['SNo']; 

      if (isset($CNo) and isset($SNo)){
        $query = "Select 
                 Sum(Grade = 'A+') As 'A+'
                ,Sum(Grade = 'A') As 'A'
                ,Sum(Grade = 'A-') As 'A-'
                ,Sum(Grade = 'B+') As 'B+'
                ,Sum(Grade = 'B') As 'B'
                ,Sum(Grade = 'B-') As 'B-'
                ,Sum(Grade = 'C+') As 'C+'
                ,Sum(Grade = 'C') As 'C'
                ,Sum(Grade = 'C-') As 'C-'
                ,Sum(Grade = 'D+') As 'D+'
                ,Sum(Grade = 'D') As 'D'
                ,Sum(Grade = 'D-') As 'D-'
                ,Sum(Grade = 'F-') As 'F'
                From Grades
                Where SNo = $SNo;";
        $result = $link->query($query);

        $query_2 = "Select Title From Courses Where CNo = $CNo;";
        $result_2 = $link->query($query_2);
        ?>
        <table class="table">
          <?php $row_2 = $result_2->fetch_assoc(); ?>
          <h2>Grades From Your <?php echo $row_2['Title']?> Section <?php echo $SNo ?></h2>
          <tr>
            <th>A+</th>
            <th>A</th>
            <th>A-</th>
            <th>B+</th>
            <th>B</th>
            <th>B-</th>
            <th>C+</th>
            <th>C</th>
            <th>C-</th>
            <th>D+</th>
            <th>D</th>
            <th>D-</th>
            <th>F</th>
          </tr>
          <?php $row = $result->fetch_assoc(); ?>
          <tr>
                <td><?php echo $row['A+']; ?></td>
                <td><?php echo $row['A']; ?></td>
                <td><?php echo $row['A-']; ?></td>
                <td><?php echo $row['B+']; ?></td>
                <td><?php echo $row['B']; ?></td>
                <td><?php echo $row['B-']; ?></td>
                <td><?php echo $row['C+']; ?></td>
                <td><?php echo $row['C']; ?></td>
                <td><?php echo $row['C-']; ?></td>
                <td><?php echo $row['D+']; ?></td>
                <td><?php echo $row['D']; ?></td>
                <td><?php echo $row['D-']; ?></td>
                <td><?php echo $row['F']; ?></td>
              </tr>
        </table>
        <?php } ?> 
      <?php
        $link->close();
        $result->free_result();
      ?>
</body>
</html>
