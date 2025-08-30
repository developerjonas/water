<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Pages;

use App\Filament\Clusters\Budget\Resources\Budgets\BudgetResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBudget extends CreateRecord
{
    protected static string $resource = BudgetResource::class;
}
