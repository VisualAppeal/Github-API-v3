<?php

require_once('Github.php');

class GithubEvents extends Github {
	
	/**
	 * List public events
	 */
	public function all() {
		return $this->request('/events');
	}
	
	/**
	 * List repository events
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function repositories($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/events');
	}
	
	/**
	 * List issue events for a repository
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function repositoryIssues($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/events');
	}
	
	/**
	 * List public events for a network of repositories
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function network($username, $repository) {
		return $this->request('/networks/'.$username.'/'.$repository.'/events');
	}
	
	/**
	 * List public events for an organization
	 *
	 * @param string $organization
	 */
	public function organization($organization) {
		return $this->request('/orgs/'.$organization.'/events');
	}
	
	/**
	 * List events that a user has received
	 *
	 * @param string $username
	 */
	public function user($username) {
		return $this->request('/users/'.$username.'/received_events');
	}
	
	/**
	 * List public events that a user has received
	 *
	 * @param string $username
	 */
	public function userPublic($username) {
		return $this->request('/users/'.$username.'/received_events/public');
	}
	
	/**
	 * List events performed by a user
	 *
	 * @param string $username
	 */
	public function userPerformed($username) {
		return $this->request('/users/'.$username.'/events');
	}
	
	/**
	 * List public events performed by a user
	 *
	 * @param string $username
	 */
	public function userPerformedPublic($username) {
		return $this->request('/users/'.$username.'/events/public');
	}
	
	/**
	 * List events for an organization
	 *
	 * @param string $username
	 * @param string $organization
	 */
	public function orgDashboard($username, $organization) {
		return $this->request('/users/'.$username.'/events/orgs/'.$organization);
	}
	
}

?>