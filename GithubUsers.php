<?php

require_once('Github.php');

class GithubUsers extends Github {
	
	/*
	 * Get a single user
	 *
	 * @param string $username
	 */
	public function get($username) {
		return $this->request('/users/'.$username);
	}
	
	/*
	 * Get the current authenticated user
	 *
	 * @param string $username
	 */
	public function me() {
		return $this->request('/user');
	}
	
	/*
	 * Update the authenticated user
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $blog
	 * @param string $company
	 * @param string $location
	 * @param boolean $hireable
	 * @param string $bio
	 */
	public function edit($name = false, $email = false, $blog = false, $company = false, $location = false, $hireable = false, $bio = false) {
		return $this->request('/user', 'PATCH', array(
			'name' => $name,
			'email' => $email,
			'blog' => $blog,
			'company' => $company,
			'location' => $location,
			'hireable' => $hireable,
			'bio' => $bio,
		));
	}
	
}

?>