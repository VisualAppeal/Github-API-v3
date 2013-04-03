<?php 

require_once('Github.php');

class GithubIssueMilestones extends Github {

	const STATE_OPEN = 'open';
	const STATE_CLOSED = 'closed';
	
	/**
	 * List milestones for a repository
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listRepository($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/milestones');
	}
	
	/**
	 * Get a single milestone
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $number
	 */
	public function get($username, $repository, $number) {
		return $this->request('/repos/'.$username.'/'.$repository.'/milestones/'.$number);
	}
	
	/**
	 * Create a milestone
	 *
	 * @param string $username
	 * @param string $repository
	 * @param string $title
	 * @param string $state (GithubIssueMilestones::STATE_OPEN, GithubIssueMilestones::STATE_CLOSED)
	 * @param string $description
	 * @param date $due_on
	 */
	public function create($username, $repository, $title, $state = false, $description = false, $due_on = false) {
		return $this->request('/repos/'.$username.'/'.$repository.'/milestones', 'POST', array(
			'title' => $title,
			'state' => $state,
			'description' => $description,
			'due_on' => date('c', strtotime($due_on)),
		));
	}
	
	/**
	 * Update a milestone
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $number
	 * @param string $title
	 * @param string $state (GithubIssueMilestones::STATE_OPEN, GithubIssueMilestones::STATE_CLOSED)
	 * @param string $description
	 * @param date $due_on
	 */
	public function edit($username, $repository, $number, $title, $state = false, $description = false, $due_on = false) {
		return $this->request('/repos/'.$username.'/'.$repository.'/milestones/'.$number, 'PATCH', array(
			'title' => $title,
			'state' => $state,
			'description' => $description,
			'due_on' => date('c', strtotime($due_on)),
		));
	}
	
	/**
	 * Delete a milestone
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $number
	 */
	public function delete($username, $repository, $number) {
		return ($this->request('/repos/'.$username.'/'.$repository.'/milestones/'.$number, 'DELETE', array(), true) == 204) ? true : false;
	}
	
}

?>