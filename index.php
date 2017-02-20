<?php require('php-logic/calculate.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Split the Bill</title>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- customize -->
    <link rel="stylesheet" href="styles/styles.css" />
    <script src="js/document.js"></script>

</head>
<body>

    <section class="intro">
        <h1>Split the Bill</h1>
        <p>
            Congratulations, you're splitting the bill!
            <br />
            How much will everyone pay?
        </p>
    </section>

    <section class="calculator">

        <?php if ($errors): ?>
            <div class="alert alert-danger" role="alert">
                Please answer the questions correctly!
            	<?php foreach($errors as $error): ?>
					<br />
                    <?=$error?>
				<?php endforeach; ?>
		    </div>
        <?php endif; ?>

        <form method="get" action="index.php">

            <div class="form-item">
                <label>How much is the bill?</label>
                $
                <input type="text" name="billAmount" class="bill-amount" required value="<?=$form->prefill('billAmount')?>"/>
            </div>

            <div class="form-item">
                <label>How many people are paying?</label>
                <select name="numberOfPeople">
                    <?php for ($i=1; $i<=50; $i++): ?>
                        <option value="<?=$i?>">
                            <?=$i?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-item">
                <label>
                    Include tip?
                </label>
                <input type="checkbox" name="includeTip" class="js-includeTip" <?php if($form->isChosen('includeTip')) echo 'CHECKED' ?> />
            </div>

            <div class="form-item js-tipPercent <?php if(!($form->isChosen('includeTip'))) echo 'hidden' ?>">
                <label>
                    OK, how much tip?
                </label>
                <select name="tipPercent">
                    <option value="15">15</option>
                    <option value="18">18</option>
                    <option value="20">20</option>
                </select>
                %
            </div>

            <div class="form-item">
                <label>
                    Round up?
                </label>
                <input type="checkbox" name="roundUp" <?php if($form->isChosen('includeTip')) echo 'CHECKED' ?> />
            </div>

            <div class="form-item submit-button">
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>

        <?php if (!$form->hasErrors): ?>
            <div class="alert alert-success" role="alert">
                Everybody's paying $<?=$result?>!
            </div>
        <?php endif; ?>

    </section>

</body>
</html>
