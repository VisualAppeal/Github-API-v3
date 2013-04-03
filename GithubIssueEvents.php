<?php 

require_once('Github.php');

class GithubIssueEvents extends Github {
	
	/**
	 * List events for a repository
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listRepository($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/events');
	}
	
	/**
	 * List events for an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $issueNr
	 */
	public function listIssue($username, $repository, $issueNr) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/events');
	}
	
	/**
	 * Get a single event
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $id
	 */
	public function get($username, $repository, $id) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/events/'.$id);
	}
	
}

?>