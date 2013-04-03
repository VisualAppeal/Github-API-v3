<?php

require_once('Github.php');

class GithubOrgs extends Github {
	
	/**
	 * List all public organizations for a user.
	 *
	 * @param string $username
	 */
	public function listUserOrgs($username) {
		return $this->request('/users/'.$username.'/orgs');
	}
	
	/**
	 * List public and private organizations for the authenticated user
	 */
	public function listOwnOrgs() {
		return $this->request('/user/orgs');
	}
	
	/**
	 * Get single organization
	 */
	public function get($organization) {
		return $this->request('/orgs/'.$organization);
	}
	
	/**
	 * Edit organization
	 *
	 * @param string $billing_email Default: false
	 * @param string $company Default: false
	 * @param string $email Default: false
	 * @param string $location Default: false
	 * @param string $name Default: false
	 */
	public function edit($organization, $billing_email = false, $company = false, $email = false, $location = false, $name = false) {
		return $this->request('/orgs/'.$organization, 'PATCH', array(
			'billing_email' => $billing_email,
			'company' => $company,
			'email' => $email,
			'location' => $location,
			'name' => $name,
		));
	}
	
}

?>