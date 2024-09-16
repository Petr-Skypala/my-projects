<?php

declare(strict_types=1);

namespace App\UI\Home;

use Nette;

#[Requires(sameOrigin: true)]
final class HomePresenter extends Nette\Application\UI\Presenter
{
    /**
     * Konstruktor
     */
    public function __construct(
    )  {
        parent::__construct();
    }
    
}
