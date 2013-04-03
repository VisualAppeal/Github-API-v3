<?php

require_once('Github.php');

class GithubGists extends Github {
	
	/**
	 * List a user’s gists:
	 *
	 * @param string $username
	 */
	public function listUser($username) {
		return $this->request('/users/'.$username.'/gists');
	}
	
	/**
	 * List the authenticated user’s gists or if called anonymously, this will return all public gists
	 */
	public function listOwn() {
		return $this->request('/gists');
	}
	
	/**
	 * List all public gists
	 */
	public function listPublic() {
		return $this->request('/gists/public');
	}
	
	/**
	 * List the authenticated user’s starred gists
	 */
	public function listStarred() {
		return $this->request('/gists/starred');
	}
	
	/**
	 * Get a single gist
	 *
	 * @param string $id
	 */
	public function get($id) {
		return $this->request('/gists/'.$id);
	}
	
	/**
	 * Create a gist
	 *
	 * @param boolean $public
	 * @param array $files
	 *		"file1.txt": {
	 *			"content": "String file contents"
     *		}
     * @param string $description
	 */
	public function create($public, $files, $description = false) {
		return $this->request('/gists', 'POST', array(
			'public' => $public,
			'files' => $files,
			'description' => $description,
		));
	}
	
	/**
	 * Edit a gist
	 *
	 * @param string $id
	 * @param array $files 
	 *		"file1.txt": {
	 *			"content": "updated file contents"
	 *		},
	 *		"old_name.txt": {
	 *			"filename": "new_name.txt",
	 *			"content": "modified contents"
	 *		},
	 *		"new_file.txt": {
	 *			"content": "a new file"
	 *		},
	 *		"delete_this_file.txt": null
	 * @param string $description
	 */
	public function edit($id, $files, $description = false) {
		return $this->request('/gists/'.$id, 'PATCH', array(
			'files' => $files,
			'description' => $description,
		));
	}
	
	/**
	 * Star a gist
	 *
	 * @param string $id
	 */
	public function star($id) {
		$result = $this->request('/gists/'.$id.'/star', 'PUT');
		return (is_null($result)) ? true : false;
	}
	
	/**
	 * Unstar a gist
	 *
	 * @param string $id
	 */
	public function unstar($id) {
		$result = $this->request('/gists/'.$id.'/star', 'DELETE');
		return (is_null($result)) ? true : false;
	}
	
	/**
	 * Check if a gist is starred
	 *
	 * @param string $id
	 */
	public function checkStar($id) {
		$result = $this->request('/gists/'.$id.'/star');
		return (is_null($result)) ? true : false;
	}
	
	/**public function fork($id) {
		return $this->request('/gists/'.$id.'/fork', 'POST');
	}*/
	
	/**
	 * Delete a gist
	 * 
	 * @param string $id
	 */
	public function delete($id) {
		$result = $this->request('/gists/'.$id, 'DELETE');
		return (is_null($result)) ? true : false;
	}
	
}

?>