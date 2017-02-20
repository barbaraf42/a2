<?php

require("Tools.php");
require("Form.php");

$form = new DWA\Form($_GET);
$tools = new DWA\Tools;
$errors = [];
$result = 0;

if ($form->isSubmitted()) {

    // get the form values
    $billAmount = $form->get('billAmount', $default = 0); # String -> Float
    $numberOfPeople = $form->get('numberOfPeople', $default = '1'); # String -> Integer
    $includeTip = $form->isChosen('includeTip'); # Boolean
    $tipPercentInForm = $form->get('tipPercent', $default = '15'); # String -> Integer
    $tipPercentToCalculate = ($includeTip) ? $tipPercentInForm : '0'; # String
    $roundUp = $form->isChosen('roundUp'); # Boolean

    // validate these form items
    $errors = $form->validate(
        [
            'billAmount' => 'required|numeric',
        ]
    );

    // calculate per person bill if there are no errors
    if(!$errors) {

        $totalBill = floatval($billAmount) + (floatval($billAmount) * (intval($tipPercentToCalculate) / 100));
        $onePersonBill = $totalBill / intval($numberOfPeople);
        $onePersonBill = round($onePersonBill, 2);
        if ($roundUp) {
            $onePersonBill = round($onePersonBill, 0, PHP_ROUND_HALF_UP);
        }
        $result = $onePersonBill;
    }

    $tools->dump($form);

}
