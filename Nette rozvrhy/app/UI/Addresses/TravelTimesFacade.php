<?php

declare(strict_types=1);

namespace App\UI\Addresses;

use App\UI\Accessory\DbFacade;

#[Requires(sameOrigin: true)]
final class TravelTimesFacade
{
    /**
     * Konstruktor
     * @param DbFacade $db
     */
    public function __construct(
        private DbFacade $db,
        
    ) {
    }
    /**
     * Přidá nové kombinace přejezdů s novou adresou
     * @param int $newId
     * @return void
     */
    public function insertJourneys(int $newId) : void
    {
        $rowsTravelTimes = $this->db->count('travel_times'); //vrátí počet řádků v tabulce travel_times
        $newAddress = $this->db->getById('addresses', $newId); //vrátí nově vloženou adresu
                
        // Pokud je databáze prázdná a jedná se o první záznam
        if ($rowsTravelTimes == 0) {
        
            $data = array(
                'place_A' => $newAddress['id'],
                'address_A' => $newAddress['street'].' '.$newAddress['number'].'/'.$newAddress['indicative'].', '.$newAddress['city'],
                'place_B' => $newAddress['id'],
                'address_B' => $newAddress['street'].' '.$newAddress['number'].'/'.$newAddress['indicative'].', '.$newAddress['city'],
                );
            $this->db->insert('travel_times', $data);
            
        } else {
        
            $locations = $this->db->getAll('travel_times')->group('place_A');

            // Vloží novou kombinaci adres
            foreach ($locations as $location) {
            
                $journey = array(
                    'place_A' => $newAddress['id'],
                    'address_A' => $newAddress['street'].' '.$newAddress['number'].'/'.$newAddress['indicative'].', '.$newAddress['city'],
                    'place_B' => $location['place_A'],
                    'address_B' => $location['address_A'],
                );
                $this->db->insert('travel_times', $journey);
            }
        }
    }
    
}