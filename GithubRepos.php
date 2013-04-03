<?php

require_once('Github.php');

class GithubRepos extends Github {
	
	/**
	 * List repositories for the authenticated user
	 */
	public function listOwn() {
		return $this->request('/user/repos');
	}
	
	/**
	 * List public repositories for the specified user
	 */
	public function listUser($username) {
		return $this->request('/users/'.$username.'/repos');
	}
	
	/**
	 * List repositories for the specified org
	 */
	public function listOrg($organization) {
		return $this->request('/orgs/'.$organization.'/repos');
	}
	
	/**
	 * Create a new repository for the authenticated user
	 *
	 * @param string $name
	 * @param string $description Default: false
	 * @param string $homepage Default: false
	 * @param boolean $private Default: false
	 * @param boolean $has_issues Default: false
	 * @param boolean $has_wiki Default: false
	 * @param boolean $has_downloads Default: false
	 * @param int $team_id Default: false
	 */
	public function create($name, $description = false, $homepage = false, $private = false, $has_issues = false, $has_wiki = false, $has_downloads = false, $team_id = false) {
		return $this->request('/user/repos', 'POST', array(
			'name' => $name,
			'description' => $description,
			'homepage' => $homepage,
			'private' => $private,
			'has_issues' => $has_issues,
			'has_wiki' => $has_wiki,
			'has_downloads' => $has_downloads,
			'team_id' => $team_id,
		));
	}
	
	/**
	 * Create a new repository in this organization. The authenticated user must be a member of $organization
	 *
	 * @param string $organization
	 * @param string $name
	 * @param string $description Default: false
	 * @param string $homepage Default: false
	 * @param boolean $private Default: false
	 * @param boolean $has_issues Default: false
	 * @param boolean $has_wiki Default: false
	 * @param boolean $has_downloads Default: false
	 * @param int $team_id Default: false
	 */
	public function createOrg($organization, $name, $description = false, $homepage = false, $private = false, $has_issues = false, $has_wiki = false, $has_downloads = false, $team_id = false) {
		return $this->request('/orgs/'.$organization.'/repos', 'POST', array(
			'name' => $name,
			'description' => $description,
			'homepage' => $homepage,
			'private' => $private,
			'has_issues' => $has_issues,
			'has_wiki' => $has_wiki,
			'has_downloads' => $has_downloads,
			'team_id' => $team_id,
		));
	}
	
	/**
	 * Create a new repository for the authenticated user
	 *
	 * @param string $username
	 * @param string $repository
	 * @param string $name
	 * @param string $description Default: false
	 * @param string $homepage Default: false
	 * @param boolean $private Default: false
	 * @param boolean $has_issues Default: false
	 * @param boolean $has_wiki Default: false
	 * @param boolean $has_downloads Default: false
	 * @param int $team_id Default: false
	 */
	public function edit($username, $repository, $name, $description = false, $homepage = false, $private = false, $has_issues = false, $has_wiki = false, $has_downloads = false, $team_id = false) {
		return $this->request('/repos/'.$username.'/'.$repository, 'PATCH', array(
			'name' => $name,
			'description' => $description,
			'homepage' => $homepage,
			'private' => $private,
			'has_issues' => $has_issues,
			'has_wiki' => $has_wiki,
			'has_downloads' => $has_downloads,
			'team_id' => $team_id,
		));
	}
	
	/**
	 * Get repository
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function get($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository);
	}
	
	/**
	 * List contributors
	 *
	 * @param string $username
	 * @param string $repository
	 * @param boolean $anon Include anonymous contributors in results
	 */
	public function listContributors($username, $repository, $anon = false) {
		return $this->request('/repos/'.$username.'/'.$repository.'/contributors', 'GET', array(
			'anon' => $anon,
		));
	}
	
	/**
	 * List languages
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listLanguages($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/languages');
	}
	
	/**
	 * List teams
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listTeams($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/teams');
	}
	
	/**
	 * List tags
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listTags($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/tags');
	}
	
	/**
	 * List branches
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listBranches($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/branches');
	}
	
}

?>