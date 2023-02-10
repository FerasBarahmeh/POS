<?php

namespace APP\LIB;

trait Validation
{

    private array $_regexPatterns = [
        'num' => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int' => '/^[0-9]+$/',
        'float' => '/^[0-9]+\.[0-9]+$/',
        'alpha' => '/^[a-zA-Z\p{Arabic} ]+$/u',
        'alphanum' => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
        'vdate' => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'url' => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
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
        return (bool)preg_match($this->_regexPatterns['alphanum'], $value);
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

    public function min($value, $min)
    {
        if (is_string($value)) {
            return mb_strlen($value) >= $min;
        } elseif (is_numeric($value)) {
            return $value >= $min;
        }
    }

    public function max($value, $max)
    {
        if (is_string($value)) {
            return mb_strlen($value) <= $max;
        } elseif (is_numeric($value)) {
            return $value <= $max;
        }
    }

    public function between($value, $min, $max)
    {
        if (is_string($value)) {
            return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
        } elseif (is_numeric($value)) {
            return $value >= $min && $value <= $max;
        }
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
        return (bool)preg_match($this->_regexPatterns['vdate'], $value);
    }

    public function email($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['email'], $value);
    }

    public function url($value): bool
    {
        return (bool)preg_match($this->_regexPatterns['url'], $value);
    }
}