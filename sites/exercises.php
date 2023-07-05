<?php
session_start();
require '../engine/db-conn-aufgabe.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aufgaben Ansehen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/fe-style-1.css">
</head>

<body>

  <div class="container-fluid">
    <div class="container-fluid d-flex justify-content-center align-items-center p-5 bg-dark">
      <h1 class="display-4 text-white">Exercises Overview</h1>
    </div>
    <div class="container">
      <div class="container-fluid form-group d-flex justify-content-around">
      </div>
      <div class="container-fluid d-flex flex-wrap justify-content-around align-items-center p-3 border-bottom">
        <h1 class="text-white">Filter:</h1>
        <?php
        require '../engine/exercise-filter.php';
        ?>
        <form class="d-flex flex-wrap justify-content-around align-items-center" method="get">
          <div class="form-group col-md-auto col-12 mx-md-2 mb-md-0 mb-3">
            <select class="form-control shadow-lg" name="fach" id="fachSelect">
              <option value="">Select subject</option>
              <?php foreach ($fachOptions as $fachOption) : ?>
                <option value="<?php echo $fachOption; ?>"><?php echo $fachOption; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-md-auto col-12 mx-md-2 mb-md-0 mb-3">
            <select class="form-control shadow-lg" name="kategorie" id="kategorieSelect">
              <option value="">Select category</option>
              <?php foreach ($kategorieOptions as $kategorieOption) : ?>
                <option value="<?php echo $kategorieOption; ?>"><?php echo $kategorieOption; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-auto col-12 mx-md-2 mb-md-0 mb-3">
            <button type="submit" class="btn btn-primary shadow-lg">Filter</button>
            <?php
            require '../engine/btn-back-to-mm.php';
            ?>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#id</th>
          <th scope="col">Aufgabe Name</th>
          <th scope="col">Beschreibung</th>
          <th scope="col">Hinweis</th>
          <th scope="col">Fach</th>
          <th scope="col">Kategorie</th>
          <th scope="col">Datum</th>
          <th scope="col">Added By</th>'
          <th scope="col">PDF File</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Include the updated code from show-exercises.php
        require '../engine/display-exercises.php';
        ?>
      </tbody>
    </table>
  </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>

</body>

</html>