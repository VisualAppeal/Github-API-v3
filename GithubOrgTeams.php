<?php

require_once('Github.php');

class GithubOrgTeams extends Github {

	const PERMISSION_PULL = 'pull';
	const PERMISSION_PUSH = 'push';
	const PERMISSION_ADMIN = 'admin';
	
	/**
	 * List teams
	 *
	 * @param string $organization
	 */
	public function listOrg($organization) {
		return $this->request('/orgs/'.$organization.'/teams');
	}
	
	/**
	 * Get team
	 *
	 * @param int $id Team ID
	 */
	public function get($id) {
		return $this->request('/teams/'.$id);
	}
	
	/**
	 * Create team
	 *
	 * @param string $organization
	 * @param string $name
	 * @param array $repo_names
	 * @param string $permission GithubOrgTeams::PERMISSION_PULL, GithubOrgTeams::PERMISSION_PUSH or GithubOrgTeams::PERMISSION_ADMIN
	 */
	public function create($organization, $name, $repo_names = false, $permission = false) {
		return $this->request('/orgs/'.$organization.'/teams', 'POST', array(
			'name' => $name,
			'repo_names' => $repo_names,
			'permission' => $permission,
		));
	}
	
	/**
	 * Edit team
	 *
	 * @param int $id Team ID
	 * @param string $name
	 * @param string $permission GithubOrgTeams::PERMISSION_PULL, GithubOrgTeams::PERMISSION_PUSH or GithubOrgTeams::PERMISSION_ADMIN
	 */
	public function edit($id, $name, $permission = false) {
		return $this->request('/teams/'.$id, 'PATCH', array(
			'name' => $name,
			'permission' => $permission,
		));
	}
	
	/**
	 * Delete team
	 *
	 * @param int $id Team ID
	 */
	public function delete($id) {
		return ($this->request('/teams/'.$id, 'DELETE', array(), true) == 204) ? true : false;
	}
	
	/**
	 * List team members
	 *
	 * @param int $id Team ID
	 */
	public function members($id) {
		return $this->request('/teams/'.$id.'/members');
	}
	
	/**
	 * Check if the user is a team member
	 *
	 * @param int $id Team ID
	 * @param string $username
	 */
	public function isMember($id, $username) {
		return ($this->request('/teams/'.$id.'/members/'.$username, 'GET', array(), true) == 204) ? true : false;
	}
	
	/**
	 * Add team member
	 *
	 * @param int $id Team ID
	 * @param string $username
	 */
	public function addMember($id, $username) {
		return ($this->request('/teams/'.$id.'/members/'.$username, 'PUT', array(), true) == 204) ? true : false;
	}
	
	/**
	 * Remove team member
	 *
	 * @param int $id Team ID
	 * @param string $username
	 */
	public function removeMember($id, $username) {
		return ($this->request('/teams/'.$id.'/members/'.$username, 'DELETE', array(), true) == 204) ? true : false;
	}
	
	/**
	 * List team repos
	 *
	 * @param int $id Team ID
	 */
	public function listRepositories($id) {
		return $this->request('/teams/'.$id.'/repos');
	}
	
	/**
	 * Is team repo
	 *
	 * @param int $id Team ID
	 * @param string $username
	 * @param string $repository
	 */
	public function isRepository($id, $username, $repository) {
		return ($this->request('/teams/'.$id.'/repos/'.$username.'/'.$repository, 'GET', array(), true) == 204) ? true : false;
	}
	
	/**
	 * Add team repo
	 *
	 * @param int $id Team ID
	 * @param string $username
	 * @param string $repository
	 */
	public function addRepository($id, $username, $repository) {
		return ($this->request('/teams/'.$id.'/repos/'.$username.'/'.$repository, 'PUT', array(), true) == 204) ? true : false;
	}
	
	/**
	 * Remove team repo
	 *
	 * @param int $id Team ID
	 * @param string $username
	 * @param string $repository
	 */
	public function removeRepository($id, $username, $repository) {
		return ($this->request('/teams/'.$id.'/repos/'.$username.'/'.$repository, 'DELETE', array(), true) == 204) ? true : false;
	}
	
}

?>