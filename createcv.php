<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
include "coonexion.php";
?>
<?php include "index.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create cv</title>
  <style>
    td,
    tr,
    th {
      text-align: left;
    }
  </style>
</head>

<body>
  <form action="cv.php" method="post">
    <fieldset>
      <legend>Create your CV easily </legend>
      <table>
        <tr>
          <th>Job Name:</th>
          <td><input type="text" name="job" id=""></td>
        </tr>
        <th>Job description:</th>
        <td><input type="text" name="jobd" id=""></td>
        </tr>
      </table>

      <h2>Job Experiences :</h2> <br>

      <table>
        <tr>
          <th>Job Experience N°1 :</th>
          <td><input type="text" name="nexp1" id=""></td>
        </tr>
        <tr>
          <th>Experience N°1:</th>
          <td><input type="text" name="exp1" id=""></td>
        </tr>

        <tr>
          <th>Job Experience N°2 :</th>
          <td><input type="text" name="nexp2" id=""></td>
        </tr>
        <tr>
          <th>Experience N°2:</th>
          <td><input type="text" name="exp2" id=""></td>
        </tr>
      </table>

      <h2>Interests: </h2><br>

      <table>
        <tr>
          <th>Interest N°1 :</th>
          <td><input type="text" name="nint1" id=""></td>
        </tr>
        <tr>
          <th>List them:</th>
          <td><input type="text" name="int1" id=""></td>
        </tr>

        <tr>
          <th>Interest N°2 :</th>
          <td><input type="text" name="nint2" id=""></td>
        </tr>
        <tr>
          <th>List them:</th>
          <td><input type="text" name="int2" id=""></td>
        </tr>
      </table>

      <h2>Projects: </h2><br>

      <table>
        <tr>
          <th>Number of projects :</th>
          <td><input type="text" name="nbpro1" id=""></td>
        </tr>
        <tr>
          <th>Brief description:</th>
          <td><input type="text" name="dpro1" id=""></td>
        </tr>
        <tr>
          <th>Out of 100% what are you good at? :</th>
          <td></td>
        </tr>
        <tr>
          <th>Number 1 skill:</th>
          <td><input type="text" name="nbsk1" id=""></td>
        </tr>
        <tr>
          <th>Number 1 skill name:</th>
          <td><input type="text" name="nsk1" id=""></td>
        </tr>
        <th>Number 1 skill description:</th>
        <td><input type="text" name="dbsk1" id=""></td>
        </tr>
        <tr>
          <th>Number 2 skill:</th>
          <td><input type="text" name="nbsk2" id=""></td>
        </tr>
        <tr>
          <th>Number 2 skill name: </th>
          <td><input type="text" name="nsk2" id=""></td>
        </tr>
        <tr>
          <th>Number 2 skill description: </th>
          <td><input type="text" name="dbsk2" id=""></td>
        </tr>
        <tr>
          <th>Number 3 skill:</th>
          <td><input type="text" name="nbsk3" id=""></td>
        </tr>
        <tr>
          <th>Number 3 skill name: </th>
          <td><input type="text" name="nsk2" id=""></td>
        </tr>
        <tr>
          <th>Number 3 skill description: </th>
          <td><input type="text" name="dbsk3" id=""></td>
        </tr>
      </table>

      <h2>Side Experiences: </h2> <br>
      <table>
        <tr>
          <th>Side Experience N°1 :</th>
          <td><input type="text" name="etraexp1" id=""></td>
        </tr>
        <tr>
          <th>Side Experience N°2 :</th>
          <td><input type="text" name="extraexp2" id=""></td>
        </tr>
      </table>

      <h2>Education: </h2> <br>

      <table>
        <tr>
          <th>Education N°1:</th>
          <td><input type="text" name="educ1" id=""></td>
        </tr>
        <tr>
          <th>Education N°2:</th>
          <td><input type="text" name="educ2" id=""></td>
        </tr>
      </table>

    </fieldset>
    <button type="submit" name="submit">Submit</button>
  </form>

</body>

</html>