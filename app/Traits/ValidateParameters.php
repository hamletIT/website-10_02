<?php

namespace App\Traits;

/**
 * Trait ValidateParameters
 *
 * This trait provides common validation rules for parameters used in various classes.
 * It includes rules for required fields, integers, strings, and a specific email validation rule for global usage.
 */
trait ValidateParameters
{
    protected string $_required = 'required';
    protected string $_integer = 'integer';
    protected string $_string = 'string';
    protected string $emailGlobal = 'required|string|email|max:255|unique:users';
}
