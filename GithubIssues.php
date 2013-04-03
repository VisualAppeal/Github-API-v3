<?php

require_once('Github.php');

class GithubIssues extends Github {
	
	/**
	 * List your issues
	 */	
	public function listOwn() {
		return $this->request('/issues');
	}
	
	/**
	 *List issues for a repository
	 *
	 * @param string $username
	 * @param string $repository
	 */
	public function listAll($username, $repository) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues');
	}
	
	/**
	 * Get a single issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $number Issue Number
	 */
	public function get($username, $repository, $number) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$number);
	}
	
	/**
	 * Create an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param string $title Issue title
	 * @param string $body Issue Body. Default: false
	 * @param string $assignee Login for the user that this issue should be assigned to. Default: false
	 * @param int $milestone Milestone ID. Default: false
	 * @param array $labels String array with labels. Default: false
	 *
	 */
	public function create($username, $repository, $title, $body = false, $assignee = false, $milestone = false, $labels = false) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues', 'POST', array(
			'title' => $title,
			'body' => $body,
			'assignee' => $assignee,
			'milestone' => $milestone,
			'labels' => $labels,
		));
	}
	
	/**
	 * Edit an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $number Issue number
	 * @param string $title Issue title
	 * @param string $body Issue Body. Default: false
	 * @param string $assignee Login for the user that this issue should be assigned to. Default: false
	 * @param int $milestone Milestone ID. Default: false
	 * @param array $labels String array with labels. Default: false
	 *
	 */
	public function edit($username, $repository, $number, $title = false, $body = false, $assignee = false, $state = false, $milestone = false, $labels = false) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$number, 'PATCH', array(
			'title' => $title,
			'body' => $body,
			'assignee' => $assignee,
			'state' => $state,
			'milestone' => $milestone,
			'labels' => $labels,
		));
	}
	
}

?>