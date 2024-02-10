<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\WebSites;

class WebsiteIdExists implements Rule
{
    public function passes($attribute, $value)
    {
        return WebSites::where('id', $value)->exists();
    }

    public function message(): string
    {
        return "There is no website with a similar ID";
    }
}
