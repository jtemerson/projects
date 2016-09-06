<?php
namespace Register {
    class Validate {
        private $fields;

        public function __construct() {
            $this->fields = new Fields();
        }

        public function getFields() {
            return $this->fields;
        }

        // Validate a generic text field
        public function text($name, $value,
                $required = true, $min = 1, $max = 255) {

            // Get Field object
            $field = $this->fields->getField($name);

            // If field is not required and empty, remove errors and exit
            if (!$required && empty($value)) {
                $field->clearErrorMessage();
                return;
            }

            // Check field and set or clear error message
            if ($required && empty($value)) {
                $field->setErrorMessage('Required.');
            } else if (strlen($value) < $min) {
                $field->setErrorMessage('Too short.');
            } else if (strlen($value) > $max) {
                $field->setErrorMessage('Too long.');
            } else {
                $field->clearErrorMessage();
            }
        }

        public function email($name, $value, $required = true) {
            $field = $this->fields->getField($name);

            // If field is not required and empty, remove errors and exit
            if (!$required && empty($value)) {
                $field->clearErrorMessage();
                return;
            }

            // Use filter_var method to validate the email address
            $email = filter_var($value, FILTER_VALIDATE_EMAIL);
            
            // If email address is not valid, set error message and exit
            if ($email === false) {
                $field->setErrorMessage("Invalid email address");
            } else {
                $field->clearErrorMessage();                
            }
        }

        public function password($name, $password, $required = true) {
            $field = $this->fields->getField($name);

            if (!$required && empty($password)) {
                $field->clearErrorMessage();
                return;
            }

            $this->text($name, $password, $required, 8);   // require at least 8 characters
            if ($field->hasError()) { return; }

            // Patterns to validate password
            $charClasses = array();
            $charClasses[] = '[:digit:]';
            $charClasses[] = '[:upper:]';
            $charClasses[] = '[:lower:]';
            // $charClasses[] = '_-';     // Don't require any special characters

            $pw = '/^';
            $valid = '[';
            foreach($charClasses as $charClass) {
                $pw .= '(?=.*[' . $charClass . '])';
                $valid .= $charClass;
            }
            $valid .= ']{6,}';
            $pw .= $valid . '$/';

            $pwMatch = preg_match($pw, $password);

            if ($pwMatch === false) {
                $field->setErrorMessage('Error testing password.');
                return;
            } else if ($pwMatch != 1) {
                $field->setErrorMessage(
                    'Must have at least one uppercase letter and one number.');
                return;
            }
        }

        public function verify($name, $password, $verify, $required = true) {
            $field = $this->fields->getField($name);
            $this->text($name, $verify, $required, 6);
            if ($field->hasError()) { return; }

            if (strcmp($password, $verify) != 0) {
                $field->setErrorMessage('Passwords do not match.');
                return;
            }
        }

    }
}
?>