<?php

require_once('Github.php');

class GithubUserEmails extends Github {
	
	/**
	 * List email addresses for the current user
	 */
	public function listOwn() {
		return $this->request('/user/emails');
	}
	
	/**
	 * Add email address
	 *
	 * @param string $email
	 */
	public function add($email) {
		return $this->request('/user/emails', 'POST', $email);
	}
	
	/**
	 * Delete email address
	 *
	 * @param string $email
	 */
	public function remove($email) {
		return ($this->request('/user/emails', 'DELETE', $email, true) == 204) ? true : false;
	}
	
}

?>