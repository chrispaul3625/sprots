<?php
namespace Edu\Cnm\dmartinez337\sprots;

require_once("autoLoader.php");

/**
 * This will be the class for a profile to chose favorite teams
 *
 * @author Dom Kratos <mr.kratos85@gmail.com>
 **/
class favoriteTeam {
	/**
	*id for the profile that has favorites; this is the foreign key
	*@var int $favoriteTeamProfileId
	**/
	private $favoriteTeamProfileId;
	/**
	*id of the team that is being favorited.
	*@var int $favoriteTeamTeamId
	**/
	private $favoriteTeamTeamId;

	/**
	*constructor for favorting a team
	*
	*@param int|nul
	**/

	/**
	* constructor for forvoritng a team.
	*
	* @param int $newFavoriteTeamProfileId this will be inherieted from the profileId
	* @param int $newFavoriteTeamTeamId this will be inherieted from the teamId
	* @throws \InvalidArgumentException if data types are not valid
  * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
  * @throws \TypeError if data types violate type hints
  * @throws \Exception if some other exception occurs
	**/

	public function __construct(int $favoriteTeamProfileId, int $favoriteTeamTeamId) {
		try{
			$this->setFavoriteTeamProfileId($newFavoriteTeamProfileId);
			$this->setFavoriteTeamTeamId($newFavoriteTeamTeamId);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $rangeException) {
			throw(new \RangeException ($rangeException->getMessage(), 0, $rangeException));
		} catch(\TypeError $typeError) {
			throw(new \TypeError ($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for profiles favorite teams.
	 *
	 * @return int|null value of favoriteTeamProfileId
	 **/
	 public function getFavoriteTeamProfileId() {
		 return($this->favoriteTeamProfileId);
	 }

	 /**
		* mutator method for favoriteTeamProfileId
		*
		* @param int|null $newFavoriteTeamProfileId new value of the favoriteTeamProfileId
		* @throws \RangeException if the $newFavoriteTeamProfileIdis not positive
		* @throws \TypeError if $favoriteTeamProfileId is not an integer
		**/
		public function setFavoriteTeamProfileId(int $newFavoriteTeamProfileId) {
			if($newFavoriteTeamProfileId === null) {
				$this->$favoriteTeamProfileId = null;
				return;
			}

			//verify the favoriteTeamProfileId is positive
			if($newFavoriteTeamProfileId <=0) {
				throw(new \RangeException("favoriteTeamProfileId is not a positive number"));
			}

			//verify the favoriteTeamProfileId is an integer.
			//if($newFavoriteTeamProfileId != int)
			//convert and store the favoriteTeamProfileId
			$this->favoriteTeamProfileId = $favoriteTeamProfileId;
		}

		/**
		 *accessor method for favoriteTeamTeamId
		 *
		 * @return int|null value of favoriteTeamTeamId
		 **/
		 public function getFavoriteTeamTeamId() {
			 return($this->favoriteTeamTeamId);
		 }

		 /**
			* mutator method for favoriteTeamTeamId
			*
			* @param int|null $newFavoriteTeamTeamId new value of the favoriteTeamProfileId
			* @throws \RangeException if the $newFavoriteTeamTeamId is not positive
			* @throws \TypeError if $favoriteTeamTeamId is not an integer
			**/


}
