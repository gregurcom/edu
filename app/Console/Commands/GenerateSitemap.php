<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    public function handle(): void
    {
        Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/courses'))
            ->add(Url::create('/subscriptions'))
            ->add(Url::create('/dashboard'))
            ->add(Url::create('/lessons'))
            ->add(Url::create('/login'))
            ->add(Url::create('/register'))
            ->writeToFile(public_path('sitemap.xml'));
    }
}
