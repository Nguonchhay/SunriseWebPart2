<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task2 | Week 2</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="col-6">
                <form action="" method="POST" class="mt-5">
                    <h1>Rectangle Calculation</h1>
                    <div class="mb-3">
                        <label for="width" class="form-label">Width</label>
                        <input type="number" name="width" min="0" max="100" class="form-control" id="width">
                    </div>

                    <div class="mb-3">
                        <label for="height" class="form-label">Height</label>
                        <input type="number" name="height" min="0" max="100" class="form-control" id="height">
                    </div>
                 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <div class="mb-3">
                    <?php
                        $area = '';
                        $perimeter = '';
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $width = $_POST['width'];
                            $height = $_POST['height'];
                            $area = $width * $height;
                            $perimeter = 2 * ($width + $height);
                        }
                    ?>
                    <ul>
                        <li>Area: <?php echo $area ?> </li>
                        <li>Perimeter: <?=$perimeter ?> </li>
                    </ul>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>