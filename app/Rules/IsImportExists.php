<?php

namespace App\Rules;

use App\Import;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class IsImportExists implements Rule
{
    private $message = "Этот приход на сегодня уже добавлен! Если ошиблись обратитесь администратору";

    /**
     * @param string $attribute
     * @param mixed $importTypeId
     * @return bool
     */
    public function passes($attribute, $importTypeId)
    {
        return !Import::where('import_type_id', $importTypeId)
            ->where('import_date', Carbon::today())
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
