<?php

namespace APP\LIB;

use function APP\pr;

trait Validation
{
    private array $errors = [];
    private array $_words;
    private bool $flagIfSimpleValidation;
    private array $_regexPatterns = [
        'num'           => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'           => '/^[0-9]+$/',
        'float'         => '/^[0-9]+\.[0-9]+$/',
        'alpha'         => '/^[a-zA-Z\p{Arabic} ]+$/u',
        'alphaNum'      => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
        'vDate'         => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email'         => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'url'           => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
    ];

    public function req($value): bool
    {
        return '' != $value || !empty($value);
    }

    public function num($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['num'], $value);
    }

    public function int($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['int'], $value);
    }

    public function float($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['float'], $value);
    }

    public function alpha($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['alpha'], $value);
    }

    public function alphaNum($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['alphaNum'], $value);
    }
    public function posInt($value): bool
    {
        return $value >= 0 && is_int($value);
    }

    public function eq($value, $matchAgainst): bool
    {
        return $value == $matchAgainst;
    }

    public function eqField($value, $otherFieldValue): bool
    {
        return $value == $otherFieldValue;
    }

    public function lt($value, $matchAgainst): bool
    {
        if (is_string($value)) {
            return mb_strlen($value) < $matchAgainst;
        } elseif (is_numeric($value)) {
            return $value < $matchAgainst;
        }
        return false;
    }

    public function gt($value, $matchAgainst): bool
    {
        if (is_string($value)) {
            return mb_strlen($value) > $matchAgainst;
        } elseif (is_numeric($value)) {
            return $value > $matchAgainst;
        }
        return false;
    }

    public function min($value, $min): bool
    {
        if (is_string($value)) {
            return mb_strlen($value) >= $min;
        } elseif (is_numeric($value)) {
            return $value >= $min;
        }
        return false;
    }

    public function max($value, $max): bool
    {
        if (is_string($value)) {
            return mb_strlen($value) <= $max;
        } elseif (is_numeric($value)) {
            return $value <= $max;
        }
        return false;
    }

    public function between($value, $min, $max): bool
    {
        if (is_string($value)) {
            $length = mb_strlen($value);
            return $length >= $min && $length <= $max;
        } elseif (is_numeric($value)) {
            return $value >= $min && $value <= $max;
        }
        return false;
    }

    public function floatLike($value, $beforeDP, $afterDP): bool
    {
        if (!$this->float($value)) {
            return false;
        }
        $pattern = '/^[0-9]{' . $beforeDP . '}\.[0-9]{' . $afterDP . '}$/';
        return (bool)preg_match($pattern, $value);
    }

    public function vDate($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['vDate'], $value);
    }

    public function email($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['email'], $value);
    }

    public function url($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['url'], $value);
    }

    public function get($key)
    {
        if(array_key_exists($key, $this->_words)) {
            return $this->_words[$key];
        }
        return false;
    }

    public function feedKey ($key, $data)
    {
        if(array_key_exists($key, $this->_words)) {
            array_unshift($data, $this->_words[$key]);
            return call_user_func_array('sprintf', $data);
        }
        return false;
    }
    private function validationTowArgument(array $partsArgument, $nameAttributeValue, $nameAttribute): void
    {
        $nameMethod = $partsArgument[1][0];
        $valueMin = $partsArgument[2][0];
        if ($this->$nameMethod($nameAttributeValue, $valueMin) === false) {
            $this->message->addMessage(
                $this->feedKey("text_error_" . $nameMethod, [$this->get("table_" . $nameAttribute), $valueMin]),
                Messenger::MESSAGE_DANGER
            );
            $this->errors[$nameAttribute] = $nameAttributeValue;
        }
    }
    private function callMinMethod($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if (preg_match_all("/(min)\((\d+)\)/", $roleMethod, $minValue)) {
            $this->validationTowArgument($minValue, $nameAttributeValue, $nameAttribute);
            $this->flagIfSimpleValidation = true;
        } else {
            $this->flagIfSimpleValidation = false;
        }
    }
    private function callMaxMethod($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if (preg_match_all("/(max)\((\d+)\)/", $roleMethod, $minValue)) {
            $this->validationTowArgument($minValue, $nameAttributeValue, $nameAttribute);
            $this->flagIfSimpleValidation = true;
        } else {
            $this->flagIfSimpleValidation = false;
        }
    }
    private function ltMethod($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if (preg_match_all("/(lt)\((\d+)\)/", $roleMethod, $partsArgument)) {
            $this->validationTowArgument($partsArgument, $nameAttributeValue, $nameAttribute);
            $this->flagIfSimpleValidation = true;
        } else {
            $this->flagIfSimpleValidation = false;
        }
    }
    private function gtMethod($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if (preg_match_all("/(gt)\((\d+)\)/", $roleMethod, $minValue)) {
            $this->validationTowArgument($minValue, $nameAttributeValue, $nameAttribute);
            $this->flagIfSimpleValidation = true;
        } else {
            $this->flagIfSimpleValidation = false;
        }
    }
    private function eqMethod($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if (preg_match_all("/(eq)\((\d+)\)/", $roleMethod, $minValue)) {
            $this->validationTowArgument($minValue, $nameAttributeValue, $nameAttribute);
            $this->flagIfSimpleValidation = true;
        } else {
            $this->flagIfSimpleValidation = false;
        }
    }
    private function validationThreeArgument(array $partsArgument, $nameAttributeValue, $nameAttribute): void
    {
        $nameMethod = $partsArgument[1][0];
        $valueMin   = $partsArgument[2][0];
        $valueMax   = $partsArgument[3][0];

        if ($this->$nameMethod($nameAttributeValue, $valueMin, $valueMax) === false) {
            $this->message->addMessage(
                $this->feedKey("text_error_" . $nameMethod, [$this->get("table_" . $nameAttribute), $valueMin, $valueMax]),
                Messenger::MESSAGE_DANGER
            );
            $this->errors[$nameMethod] = $nameAttribute;
        }

    }
    private function betweenMethod($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if (preg_match_all("/(between)\((\d+),(\d+)\)/", $roleMethod, $partsArgument)) {
            $this->validationThreeArgument($partsArgument, $nameAttributeValue, $nameAttribute);
            $this->flagIfSimpleValidation = true;
        } else {
            $this->flagIfSimpleValidation = false;
        }

    }
    private function floatLikeMethod($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if (preg_match_all("/(floatLike)\((\d+),(\d+)\)/", $roleMethod, $partsArgument)) {
            $this->validationThreeArgument($partsArgument, $nameAttributeValue, $nameAttribute);
            $this->flagIfSimpleValidation = true;
        } else {
            $this->flagIfSimpleValidation = false;
        }

    }

    private function isSimpleRole($roleMethod, $nameAttributeValue, $nameAttribute): void
    {
        if($this->$roleMethod($nameAttributeValue) === false) {
            $this->errors[$roleMethod] = $nameAttributeValue;
            $this->message->addMessage (
                $this->feedKey("text_error_" . $roleMethod, [$this->get("table_" . $nameAttribute)]),
                Messenger::MESSAGE_DANGER
            );
            $this->errors[$roleMethod] = $nameAttribute;
        }
    }

    public function isAppropriate($roles, $typeInput): array|bool
    {
        $this->_words = $this->language->getDictionary();
        if ($roles) {
            foreach ($roles as $nameAttribute => $rolesFiled) {
                $nameAttributeValue = $typeInput[$nameAttribute];
                foreach ($rolesFiled as $roleMethod ) {
                     $this->callMinMethod($roleMethod, $nameAttributeValue, $nameAttribute);
                     if (! $this->flagIfSimpleValidation)
                        $this->callMaxMethod($roleMethod, $nameAttributeValue, $nameAttribute);
                    if (! $this->flagIfSimpleValidation)
                         $this->ltMethod($roleMethod, $nameAttributeValue, $nameAttribute);
                    if (! $this->flagIfSimpleValidation)
                         $this->gtMethod($roleMethod, $nameAttributeValue, $nameAttribute);
                    if (! $this->flagIfSimpleValidation)
                        $this->eqMethod($roleMethod, $nameAttributeValue, $nameAttribute);
                    if (! $this->flagIfSimpleValidation)
                         $this->betweenMethod($roleMethod, $nameAttributeValue, $nameAttribute);
                    if (! $this->flagIfSimpleValidation)
                        $this->floatLikeMethod($roleMethod, $nameAttributeValue, $nameAttribute);
                    if (! $this->flagIfSimpleValidation)
                        $this->isSimpleRole($roleMethod, $nameAttributeValue, $nameAttribute);
                }
            }

        }

        return count($this->errors) == 0 ? true : $this->errors;
    }
}