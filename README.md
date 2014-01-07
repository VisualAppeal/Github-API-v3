# Github-API-v3

PHP Github API client for version 3.

## Requirements

* PHP 5

## Installation

* Include `Gihtub.php`

## Usage Examples

```php

//Xyz = Events, Gists, Issues, Repos, Users...

$xyz = new GithubXyz('username', 'password');

/**
 * List all of your issues
 */
$issues = new GithubIssues('t-visualappeal', '123456');

$output = $issues->listOwn();

if ($issues->hasError()) {
	var_dump($issues->getErrors());
} else {
	echo $output;
}

```

## License

Copyright 2013 VisualAppeal

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
