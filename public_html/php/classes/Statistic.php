<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");


/**
 * statistic , a list of information regarding stats for players and teams.
 *
 *
 * @author Dominic Cuneo< cuneo94@gmail.com
 */
class Statistic implements \JsonSerializable{
	/**
	 * id for statistic primary key
	 * @var int $statisticId
	 */
	private $statisticId;
	/**
	 *a string  for statisticname
	 * @var string $statisticName
	 */
	private $statisticName;

	/**
	 * constructor for statistic
	 *
	 * @param int $newStatisticId id for Statistic
	 * @param string $newStatisticName for statistic
	 * @throws \RangeException data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newStatisticId = null, string $newStatisticName) {
		try {
			$this->setStatisticId($newStatisticId);
			$this->setStatisticName($newStatisticName);
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accesor method for statisticId
	 *
	 * @return int|null value for statistic id
	 */
	public function getStatisticId() {
		return $this->statisticId;
	}

	/**
	 * mutator method for statistic id
	 *
	 * @param int|null $newStatisticId new value of statistic id
	 * @throws \RangeException if $newStatisticId is not positive
	 * @throws \TypeError if $newStatisticId id not an integer
	 */
	public function setStatisticId(int $newStatisticId = null) {
		if($newStatisticId === null) {
			$this->statisticId = null;
			return;
		}
		if($newStatisticId <= 0) {
			throw(new \RangeException("statistic id not positive"));
		}
		$this->statisticId = $newStatisticId;
	}

	/**
	 * accessor method for statistic name
	 *
	 * @return string value of statistic name
	 */
	public function getStatisticName() {
		return $this->statisticName;
	}

	/**
	 * mutator method for statistic name
	 *
	 * @param string $newStatisticName new value of statistic name
	 * @throws \InvalidArgumentException if $newStatisticName is not a string
	 * @throws \RangeException if $newStatisticName is > 255 characters
	 * @throws \TypeError if $newStatisticName is not a string
	 */
	public function setStatisticName(string $newStatisticName) {
		//verify the statistic name is secure
		$newStatisticName = trim($newStatisticName);
		$newStatisticName = filter_var($newStatisticName, FILTER_SANITIZE_STRING);
		if(empty($newStatisticName) === true) {
			throw(new \InvalidArgumentException(" statistic is empty or insecure"));
		}
		if(strlen($newStatisticName) > 255) {
			throw(new \RangeException("statisticName is too large"));
		}
		$this->statisticName = $newStatisticName;
	}

	/**
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		//enforce the statisticId is null

		if($this->statisticId !== null) {
			throw(new \PDOException("not a new statistic"));
		}
		//query template
		$query = "INSERT INTO statistic(statisticId,statisticName)VALUES(:statisticId, :statisticName)";
		$statement = $pdo->prepare($query);

		//blind the member variables to the place holders in the template
		//formattedDate = $this->statisticDate->format("Y-m-d H:i:s");
		$parameters = ["statisticId" => $this->statisticId, "statisticName" => $this->statisticName];
		$statement->execute($parameters);
		//update the null statisticId with what mySQL just gave
		$this->statisticId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this Tweet from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		//enforce statisticId is not null
		if($this->statisticId === null) {
			throw(new \PDOException("unable to delete statistic that does not exist"));
		}
		// query template
		$query = "DELETE FROM statistic WHERE statisticId = :statisticId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["statisticId" => $this->statisticId];
		$statement->execute($parameters);
	}

	/**
	 * updates statistic  in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		//enforce statisticId id not null

		if($this->statisticId === null) {
			throw(new \PDOException("unable to update a statistic that does not exist"));
		}
		// query template
		$query = "UPDATE statistic SET statisticName = :statisticName";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		//$formattedDate = $this->statisticDate->format("Y-m-d H:i:s");
		$parameters = ["statisticName" => $this->statisticName];
		$statement->execute($parameters);
	}

	/**
	 * gets the statistic by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $statisticName to search for
	 * @return \SplFixedArray SplFixedArray of statistic found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getStatisticByStatisticName(\PDO $pdo, string $statisticName) {
		//sanitize the description before searching
		$statisticName = trim($statisticName);
		$statisticName = filter_var($statisticName, FILTER_SANITIZE_STRING);
		if(empty($statisticName) === true) {
			throw(new \PDOException ("statistic content is invalid"));
		}
		//query template
		$query = "SELECT statisticId, statisticName FROM statistic WHERE statisticName LIKE :statisticName";
		$statement = $pdo->prepare($query);

		//bind statistic name t o the place holder in template
		$statisticName = "%$statisticName%";
		$parameters = array("statisticName" => $statisticName);
		$statement->execute($parameters);

		// build and array for statistic
		$statistics = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$statistic = new Statistic($row["statisticId"], $row["statisticName"]);
				$statistics[$statistics->key()] = $statistic;
				$statistics->next();
			} catch(\Exception $exception){
				//if the row couldn't be converted rethrow
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
	}
		return ($statistics);
	}
	/**
	 * gets the Statistic by StatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $statisticId tweet id to search for
	 * @return Statistic|null Statistic found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getStatisticByStatisticId(\PDO $pdo, int $statisticId) {
		//sanitize the statisticID before searching
		if($statisticId <= 0) {
			throw(new\PDOException("statistic id is  not positive"));
		}
			//query template
			$query = "SELECT statisticId, statisticName FROM statistic WHERE statisticId = :statisticId";
			$statement = $pdo->prepare($query);

			//bind statistic to the place holder in the template
			$parameters = array("statisticId" => $statisticId);
			$statement->execute($parameters);

			//grab the statistic from mySql
			try {
				$statistic = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$statistic = new Statistic($row["statisticId"], $row["statisticName"]);
				}
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return($statistic);
		}
		/**
		 * gets all Statistic
		 *
		 * @param \PDO $pdo PDO connection object
		 * @return \SplFixedArray SplFixedArray of Statistic found or null if not found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 **/
		public static function getAllStatistic(\PDO $pdo){
			// create query template
			$query = "SELECT statisticId, statisticName FROM statistic";
			$statement = $pdo->prepare($query);
			$statement->execute();

			//build array of statistic
			$statistics = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false){
				try{
					$statistic = new Statistic($row["statisticId"], $row["statisticName"]);
					$statistics[$statistics->key()] = $statistic;
					$statistics->next();
				}catch(\Exception $exception){
					//if the row couldn't be converted rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			}
			return($statistics);
		}
	public function jsonSerialize() {
		return(get_object_vars($this));
	}
}
