<?php
class Connection extends PDO {

    CONST DSN='mysql:host=hina;dbname=dbadlenoir';
    CONST USERNAME='adlenoir';
    CONST PASSWORD='adlenoir';
    private $stmt;

public function __construct() {

parent::__construct(self::DSN,self::USERNAME,self::PASSWORD);
$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

/** * @param string $query 
    * @param array $parameters *
    * @return bool Returns `true` on success, `false` otherwise
*/
public function executeQuery(string $query, array $parameters = []) : bool{ 
	$this->stmt = parent::prepare($query); 
	foreach ($parameters as $name => $value) { 
	 $this->stmt->bindValue($name, $value[0], $value[1]); 
	} 

	return $this->stmt->execute(); 
}

public function getResults() : array {
 	return $this->stmt->fetchAll();
}

}