<?php
namespace App\UI\Accessory;

use Nette\Database\Explorer;
use Exception;


final class DbFacade
{
    private Explorer $database;
    /**
     * Konstruktor s databázovým spojením
     * @param Explorer $database
     */
    public function __construct(
            Explorer $database
    ) {
	$this->database = $database;
    }    
    /**
     * Vrátí položku z databáze podle id
     * @param string $table název tabulky 
     * @param type $id id položky
     * @return type
     * @throws Exception
     */
    public function getById(string $table, $id)
    {
        $result = $this->database
        ->table($table)
        ->get($id);
        if (!$result)            
            throw new Exception('Záznam nenalezen.');
        return $result;
    }
    /**
     * Vrátí všechny záznamy z vybrané tabulky
     * @param string $table název tabulky
     * @return type
     */
    public function getAll(string $table): \Nette\Database\Table\Selection
    {
        return $this->database->table($table);
    }
    /**
     * Vloží nový záznam 
     * @param string $table tabulka, do které má být záznam vložený
     * @param type $data data k vložení
     * @return void
     */
    public function insert(string $table, $data) : void
    {
        $this->database
            ->table($table)
            ->insert($data);        
    }
    /**
     * Smaže záznam z databáze
     * @param string $table název tabulky
     * @param int $id id záznamu, který se má smazat
     * @return void
     */
    public function deleteById(string $table, int $id): void
    {
        $this->database->table($table)->where('id', $id)->delete();
    }
    /**
     * Vrátí počet řádků v tabulce
     * @param string $table název tabulky
     * @return int
     */
    public function count(string $table): int
    {
        return $this->database->table($table)->count('*');
    }

}
