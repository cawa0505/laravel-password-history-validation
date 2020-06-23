<?php

namespace Infinitypaul\LaravelPasswordHistoryValidation\Traits;

use Infinitypaul\LaravelPasswordHistoryValidation\Models\PasswordHistory;

trait PasswordHistoryTrait
{
    /**
     * @return mixed
     */
    public function passwordHistory()
    {
        return $this->hasMany(PasswordHistory::class, 'user_id')
            ->whereModel(config('password-history-validation.observe.model'))
            ->latest('created_at');
    }

    public function deletePasswordHistory()
    {
        $this->passwordHistory()
            ->where('id', '<=', $this->passwordHistory()->first()->id - config('password-history-validation.keep'))
            ->delete();
    }
}
