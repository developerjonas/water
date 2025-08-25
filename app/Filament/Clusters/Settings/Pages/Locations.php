<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings\SettingsCluster;
use Filament\Pages\Page;

class Locations extends Page
{
    protected string $view = 'filament.clusters.settings.pages.locations';

    protected static ?string $cluster = SettingsCluster::class;
}
