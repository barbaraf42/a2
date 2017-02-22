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
        </p>
    </section>

    <section class="calculator">

        <?php if ($errors): ?>
            <div class="alert alert-danger" role="alert">
                Please check what you entered!
            	<?php foreach($errors as $error): ?>
					<br />
                    <?=$error?>
				<?php endforeach; ?>
		    </div>
        <?php endif; ?>

        <?php if ( ($form->isSubmitted()) && (!$form->hasErrors) ): ?>
            <div class="alert alert-success" role="alert">
                Everybody's paying $<?=$result?>!
            </div>
        <?php endif; ?>

        <form method="get" action="index.php">

            <div class="form-item">
                <label for="billAmount" class="label-required">How much is the bill?<br /><span class="required not-bold">(required)</span></label>
                $
                <input type="text" name="billAmount" id="billAmount" class="bill-amount" required value="<?=$form->prefill('billAmount')?>"/>
                <input type="hidden" name="billAmountErrorLabel" value="bill amount" />
            </div>

            <div class="form-item">
                <label for="numberOfPeople">How many people are paying?</label>
                <select name="numberOfPeople" id="numberOfPeople">
                    <?php for ($i=1; $i<=50; $i++): ?>
                        <option value="<?=$i?>" <?php if($form->get('numberOfPeople')==$i) echo "selected" ?>>
                            <?=$i?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-item">
                <label for="includeTip">
                    Include tip?
                </label>
                <input type="checkbox" name="includeTip" id="includeTip" class="js-includeTip" <?php if($form->isChosen('includeTip')) echo 'CHECKED' ?> />
            </div>

            <div class="form-item js-tipPercent <?php if(!($form->isChosen('includeTip'))) echo 'hidden' ?>">
                <label for="tipPercent">
                    OK, how much tip?
                </label>
                <select name="tipPercent" id="tipPercent">
                    <option value="15" <?php if($form->get('tipPercent')=="15") echo "selected" ?>>15</option>
                    <option value="18" <?php if($form->get('tipPercent')=="18") echo "selected" ?>>18</option>
                    <option value="20" <?php if($form->get('tipPercent')=="20") echo "selected" ?>>20</option>
                </select>
                %
            </div>

            <div class="form-item">
                <label for="roundUp">
                    Round up?
                </label>
                <input type="checkbox" name="roundUp" id="roundUp" <?php if($form->isChosen('roundUp')) echo 'CHECKED' ?> />
            </div>

            <div class="form-item submit-button">
                <button class="btn btn-primary">Split the Bill!</button>
            </div>

        </form>

    </section>

</body>

</html>
