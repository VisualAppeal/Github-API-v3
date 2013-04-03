<?php

require_once('Github.php');

class GithubUserKeys extends Github {
	
	/**
	 * List public keys for the current user
	 */
	public function listAll() {
		return $this->request('/user/keys');
	}
	
	/**
	 * Get a single public key
	 *
	 * @param int $id Key ID
	 */
	public function get($id) {
		return $this->request('/user/keys/'.$id);
	}
	
	/**
	 * Create a public key
	 *
	 * @param string $title
	 * @param string $key
	 */
	public function create($title, $key) {
		return $this->request('/user/keys', 'POST', array(
			'title' => $title,
			'key' => $key,
		));
	}
	
	/**
	 * Update a public key
	 *
	 * @param int $id Key ID
	 * @param string $title
	 * @param string $key
	 */
	public function edit($id, $title, $key) {
		return $this->request('/user/keys/'.$id, 'PATCH', array(
			'title' => $title,
			'key' => $key,
		));
	}
	
	/**
	 * Delete a public key
	 *
	 * @param int $id Key ID
	 */
	public function delete($id) {
		return $this->request('/user/keys/'.$id, 'DELETE');
	}
	
}

?>