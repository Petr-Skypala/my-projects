<?php

declare(strict_types=1);

namespace App\UI\Front;

use Nette;
use Nette\Database\Explorer;
use Nette\Utils\DateTime;

final class SalePresenter extends Nette\Application\UI\Presenter
{
    private Explorer $explorer;

    /**
     * Konstruktor
     * @param Explorer $explorer
     */
    public function __construct(
	    Explorer $explorer
    ) {
	parent::__construct();
	$this->explorer = $explorer;
    }
    /**
     * Vloží data do public stránky výprodejů
     * @return void
     */
    public function renderDefault(): void
    {
	
	$date = new DateTime;
	$date->setTime(0, 0, 0);

	// Vybere aktuální výprodej, pokud existuje
	$actualSale = $this->explorer->table('sale')->where('starts < ? AND ends >= ?', $date, $date)->fetch();
	// Vybere nejbližší nádcházející výprodej
	$closestSale = $this->explorer->table('sale')->where('starts > ?', $date)->order('starts')->limit(1)->fetch();
	
	// Pokud existuje aktuální výprodej
	if (isset($actualSale->name)) {
	    $this->template->heading = 'Právě probíhá výprodej:';
	    $this->template->sale = $actualSale;
	    $this->template->tags = $actualSale->related('sale_tag');


	    // Datum od
	    $today = new DateTime();
	    
	    $this->template->ends =  $actualSale->ends->setTime(23, 59, 0)->format('Y/m/d H:i:s');
	    $this->template->starts = $today->format('Y/m/d H:i:s');
	    $this->template->footer = 'Výprodej skončí za: ';

	// Zobrazí nejbližší plánovaný výprodej
	} else {
	    $this->template->heading = 'Nejbližší plánovaný výprodej:';
	    $this->template->sale = $closestSale;
	    $this->template->tags = $closestSale->related('sale_tag');
	    
	    // Datum od
	    $today = new DateTime();

	    $this->template->starts = $today->format('Y/m/d H:i:s');
	    $this->template->ends = $closestSale->starts->format('Y/m/d H:i:s');
	    $this->template->footer = 'Výprodej začne za: ';
	}
    }

}
