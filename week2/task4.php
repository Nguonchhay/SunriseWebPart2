<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task4 | Week 2</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <?php
            $result = '';
            $value1 = '';
            $value2 = ''; 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $value1 = intval($_POST['value1']);
                $value2 = intval($_POST['value2']); 
                $operand = $_POST['operand'];
                $result = match ($operand) {
                    'sum' => $value1 + $value2,
                    'minus' => $value1 - $value2,
                    'mul' => $value1 * $value2,
                    'div' => $value1 / $value2,
                    default => $value1 % $value2
                };
            }                      
        ?>
        <div class="container">
            <div class="col-6">
                <form action="" method="POST" class="mt-5">
                    <h1>Simple Calculator</h1>
                    <div class="mb-3">
                        <label for="value1" class="form-label">Value 1</label>
                        <input type="number" name="value1" class="form-control" id="value1" value="<?=$value1?>">
                    </div>

                    <div class="mb-3">
                        <label for="value2" class="form-label">Value 2</label>
                        <input type="number" name="value2" class="form-control" id="value2" value="<?=$value2?>">
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="operand" id="operand1" value="sum">
                            <label class="form-check-label" for="operand1">+</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="operand" id="operand2" value="minus">
                            <label class="form-check-label" for="operand2">-</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="operand" id="operand1" value="mul">
                            <label class="form-check-label" for="operand1">*</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="operand" id="operand2" value="div">
                            <label class="form-check-label" for="operand2">/</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="operand" id="operand2" value="mod">
                            <label class="form-check-label" for="operand2">%</label>
                        </div>
                    </div>
                 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <div class="mb-3">
                    <p>Result : <?=$result ?></p>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>