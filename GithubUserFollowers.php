<?php

require_once('Github.php');

class GithubUserFollowers extends Github {
	
	/*
	 * List followers of a user
	 *
	 * @param string $username
	 */
	public function listAll($username) {
		return $this->request('/users/'.$username.'/followers');
	}
	
	/*
	 * List followers of the current user
	 */
	public function listOwn() {
		return $this->request('/user/followers');
	}
	
	/*
	 * List users following another user
	 *
	 * @param string $username
	 */
	public function listFollowing($username) {
		return $this->request('/users/'.$username.'/following');
	}
	
	/*
	 * List who the authenticated user is following
	 */
	public function listOwnFollowing() {
		return $this->request('/user/following');
	}
	
	/*
	 * Check if you are following a user
	 *
	 * @param string $username
	 */
	public function isFollowing($username) {
		return ($this->request('/user/following/'.$username, 'GET', array(), true) == 204) ? true : false;
	}
	
	/*
	 * Follow a user
	 *
	 * @param string $username
	 */
	public function follow($username) {
		return ($this->request('/user/following/'.$username, 'PUT', array(), true) == 204) ? true : false;
	}
	
	/*
	 * Unfollow a user
	 *
	 * @param string $username
	 */
	public function unfollow($username) {
		return ($this->request('/user/following/'.$username, 'DELETE', array(), true) == 204) ? true : false;
	}
	
}

?>