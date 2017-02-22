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
            'billAmount' => 'required|numericValues',
        ]
    );

    // assign clearer field labels for error messages
    $fieldNameLabels = [
        'billAmount' => 'billAmount-errorLabel',
    ];

    // if there are errors, use clearer field labels
    if ($errors) {
        $newErrors = [];
        foreach($errors as $errorMessage) {
            foreach($fieldNameLabels as $fieldName => $fieldNameLabel) {
                $newFieldNameLabel = $form->sanitize($fieldNameLabel);
                $newErrors[] = str_replace($fieldName, $form->get($newFieldNameLabel), $errorMessage);
            }
        }
        $errors = $newErrors;
    }

    // calculate per person bill if there are no errors
    if(!$errors) {

        $totalBill = floatval($billAmount) + (floatval($billAmount) * (intval($tipPercentToCalculate) / 100));
        $onePersonBill = $totalBill / intval($numberOfPeople);
        $onePersonBill = round($onePersonBill, 2);
        $onePersonBill = number_format($onePersonBill, 2, '.', '');
        if ($roundUp) {
            $onePersonBill = ceil($onePersonBill);
        }
        $result = $onePersonBill;
    }

}
