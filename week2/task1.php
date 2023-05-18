<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task1 | Week 2</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        
        <div class="container">
            
            <?php
                $grade = '';
                if (isset($_POST['math'])) {
                    $math = $_POST['math'];
                    $physic = $_POST['physic'];
                    $khmer = $_POST['khmer'];
                    $chemistry = $_POST['chemistry'];
                    $average = ($math + $physic + $khmer + $chemistry) / 4;
                    
                    if ($average >= 95 && $average <= 100) {
                        $grade = 'A';
                    } else if ($average >= 90 && $average < 95) {
                        $grade = 'B';
                    } else if ($average >= 80 && $average < 90) {
                        $grade = 'C';
                    } else if ($average >= 65 && $average < 80) {
                        $grade = 'D';
                    } else if ($average >= 50 && $average < 65) {
                        $grade = 'E';
                    } else {
                        $grade = 'F';
                    }
                }
                
            ?>


            <div class="col-6">
                <form action="" method="POST" class="mt-5">
                    <h1>Grade Calculation</h1>
                    <div class="mb-3">
                        <label for="math" class="form-label">Math</label>
                        <input type="number" name="math" min="0" max="100" class="form-control" id="math">
                    </div>

                    <div class="mb-3">
                        <label for="physic" class="form-label">Physic</label>
                        <input type="number" name="physic" min="0" max="100" class="form-control" id="physic">
                    </div>

                    <div class="mb-3">
                        <label for="khmer" class="form-label">Khmer</label>
                        <input type="number" name="khmer" min="0" max="100" class="form-control" id="khmer">
                    </div>

                    <div class="mb-3">
                        <label for="chemistry" class="form-label">Chemistry</label>
                        <input type="number" name="chemistry" min="0" max="100" class="form-control" id="chemistry">
                    </div>
                 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <div class="mb-3">
                    <label>Your Grade is: <?php echo $grade ?> </label>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>