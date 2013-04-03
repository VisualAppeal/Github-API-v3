<?php 

require_once('Github.php');

class GithubOrgMembers extends Github {
	
	/**
	 * List all users who are members of an organization
	 *
	 * @param string $organization
	 */
	public function listAll($organization) {
		return $this->request('/orgs/'.$organization.'/members');
	}
	
	/**
	 * Check if the user is a member of an organization
	 *
	 * @param string $organization
	 * @param string $user
	 *
	 * @return boolean
	 */
	public function isMember($organization, $user) {
		return ($this->request('/orgs/'.$organization.'/members/'.$user, 'GET', array(), true) == '204') ? true : false;
	}
	
	/**
	 * Remove a member
	 *
	 * @param string $organization
	 * @param string $user
	 *
	 * @return boolean
	 */
	public function remove($organization, $user) {
		return ($this->request('/orgs/'.$organization.'/members/'.$user, 'GET', array(), true) == '204') ? true : false;
	}
	
	/**
	 * List public members
	 *
	 * @param string $organization
	 */
	public function listPublic($organization) {
		return $this->request('/orgs/'.$organization.'/public_members');
	}
	
	/**
	 * Check if a user is a public member
	 *
	 * @param string $organization
	 * @param string $user
	 */
	public function isPublic($organization, $user) {
		return ($this->request('/orgs/'.$organization.'/public_members/'.$user, 'GET', array(), true) == '204') ? true : false;
	}
	
	/**
	 * Publicize a user’s membership
	 *
	 * @param string $organization
	 * @param string $user
	 */
	public function setPublic($organization, $user) {
		return ($this->request('/orgs/'.$organization.'/public_members/'.$user, 'PUT', array(), true) == '204') ? true : false;
	}
	
	/**
	 * Conceal a user’s membership (Set status to private)
	 *
	 * @param string $organization
	 * @param string $user
	 */
	public function setPrivate($organization, $user) {
		return ($this->request('/orgs/'.$organization.'/public_members/'.$user, 'DELETE', array(), true) == '204') ? true : false;
	}
	
}

?>