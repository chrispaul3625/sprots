<?php
namespace Edu\Cnm\Dcuneo1\Sprots;

require_once("autoload.php");
/**
 * Created by PhpStorm.
 * User: OldManVin
 * Date: 2/2/2016
 * Time: 1:11 PM
 */
/**
 * statistic , a list of information regarding stats for players and teams.
 *
 *
 * @author Dominic Cuneo< cuneo94@gmail.com
 */

class Statistic {
	/**
	 * id for statistic
	@var int $statisticId
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
	 * @param int $statisticId id for Statistic
	 * @param string $statisticName for statistic
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
		}catch(\TypeError $typeError) {
			//rethrow the exception
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		}catch(\Exception $exception) {
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
}
