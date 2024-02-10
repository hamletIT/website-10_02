<?php

namespace App\Rules;

use App\Models\Posts;
use Illuminate\Contracts\Validation\Rule;


class WebsiteTitleExists implements Rule
{
    public function passes($attribute, $value): bool
    {
        return !Posts::where('title', $value)->exists();
    }

    public function message(): string
    {
        return "There is a post with a similar title";
    }
}
