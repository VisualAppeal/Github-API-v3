<?php

require_once('Github.php');

class GithubGistComments extends Github {
	
	/*
	 * List comments on a gist
	 *
	 * @param string $gistId Gist ID
	 */
	public function listAll($gistId) {
		return $this->request('/gists/'.$gistId.'/comments');
	}
	
	/*
	 * Get a single comment
	 *
	 * @param string $id Comment ID
	 */
	public function get($id) {
		return $this->request('/gists/comments/'.$id);
	}
	
	/*
	 * Create a comment
	 *
	 * @param string $gistId Gist ID
	 * @param string $body Comment body
	 */
	public function create($gistId, $body) {
		return $this->request('/gists/'.$gistId.'/comments', 'POST', array(
			'body' => $body,
		));
	}
	
	/*
	 * Edit a comment
	 *
	 * @param string $id Comment ID
	 * @param string $body Comment body
	 */
	public function edit($id, $body) {
		return $this->request('/gists/comments/'.$id, 'PATCH', array(
			'body' => $body,
		));
	}
	
	/*
	 * Delete a comment
	 *
	 * @param string $id
	 */
	public function delete($id) {
		return $this->request('/gists/comments/'.$id, 'DELETE');
	}
	
}

?>