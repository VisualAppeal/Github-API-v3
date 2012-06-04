<?php 

require_once('Github.php');

class GithubIssueComments extends Github {
	
	/*
	 * List comments on an issue
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $issueNr
	 */
	public function listAll($username, $repository, $issueNr) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/comments');
	}
	
	/*
	 * Get a single comment
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $commentId
	 */
	public function get($username, $repository, $commentId) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/comments/'.$commentId);
	}
	
	/*
	 * Create a comment
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $commentId
	 */
	public function create($username, $repository, $issueNr, $body) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/'.$issueNr.'/comments', 'POST', array(
			'body' => $body,
		));
	}
	
	/*
	 * Edit a comment
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $commentId
	 */
	public function edit($username, $repository, $commentId, $body) {
		return $this->request('/repos/'.$username.'/'.$repository.'/issues/comments/'.$commentId, 'POST', array(
			'body' => $body,
		));
	}
	
	/*
	 * Delete a comment
	 *
	 * @param string $username
	 * @param string $repository
	 * @param int $commentId
	 */
	public function delete($username, $repository, $commentId) {
		return ($this->request('/repos/'.$username.'/'.$repository.'/issues/comments/'.$commentId, 'DELETE', array(), true) == 204) ? true : false;
	}
	
}

?>