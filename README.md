# Gitlab-Api
This projects provides access to the gitlab-api with some useful features

## Features (so far)
- Update all issues of a project with the confidential flag

## Install
- Create the file `web/config.php` from template file `web/config.php.dist`
- Generate your [Access-Token](https://docs.gitlab.com/ee/user/profile/personal_access_tokens.html) and insert it in the `web/config.php` file
- Choose a project and paste it's namespace (`your-group/example-project`) into the config, too
- Call `web/api.php` in your browser or cli
