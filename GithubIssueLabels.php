<?php 

require_once('Github.php');

class GithubIssueLabels extends Github {
	
	/**
	 * List all labels for a repository
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listRepository($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/labels');
	}
	
	/**
	 * List labels on an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $issueNr
	 */
	public function listIssue($username, $repository, $issueNr) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/labels');
	}
	
	/**
	 * Get a single label
	 *
	 * @param string $username
	 * @param string $repository
	 * @param string $name
	 */
	public function get($username, $repository, $name) {
		return $this->request('/repos/'.$username.'/'.$repository.'/labels/'.$name);
	}
	
	/**
	 * Create a label
	 *
	 * @param string $username
	 * @param string $repository
	 * @param string $name
	 * @param string $color i.e. 'FFFFFF', 'ABCDEF'
	 */
	public function create($username, $repository, $name, $color) {
		return $this->request('/repos/'.$username.'/'.$repository.'/labels', 'POST', array(
			'name' => $name,
			'color' => $color,
		));
	}
	
	/**
	 * Update a label
	 *
	 * @param string $username
	 * @param string $repository
	 * @param string $name
	 * @param string $color i.e. 'FFFFFF', 'ABCDEF'
	 */
	public function edit($username, $repository, $name, $color) {
		return $this->request('/repos/'.$username.'/'.$repository.'/labels', 'POST', array(
			'name' => $name,
			'color' => $color,
		));
	}
	
	/**
	 * Delete a label
	 *
	 * @param string $username
	 * @param string $repository
	 * @param string $name
	 */
	public function delete($username, $repository, $name) {
		return ($this->request('/repos/'.$username.'/'.$repository.'/labels/'.$name, 'DELETE', array(), true) == 204) ? true : false;
	}
	
	/**
	 * Add labels to an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $issueNr
	 * @param array $labels
	 */
	public function add($username, $repository, $issueNr, $labels) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/labels', 'POST', $labels);
	}
	
	/**
	 * Remove a label from an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $issueNr
	 * @param array $name
	 */
	public function remove($username, $repository, $issueNr, $name) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/labels/'.$name, 'DELETE');
	}
	
	/**
	 * Replace all labels for an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $issueNr
	 * @param array $labels
	 */
	public function replace($username, $repository, $issueNr, $labels) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/labels', 'PUT', $labels);
	}
	
	/**
	 * Remove all labels from an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $issueNr
	 */
	public function removeAll($username, $repository, $issueNr) {
		return ($this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/labels', 'DELETE', array(), true) == 204) ? true : false;
	}
	
	/**
	 * List labels on an issue
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listMilestone($username, $repository, $issueNr) {
		return $this->request('/repos/'.$username.'/'.$repository.'/milestones/'.$issueNr.'/labels');
	}
	
}


?>