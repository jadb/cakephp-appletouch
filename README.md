# Apple Touch - CakePHP Plugin

Support Safari on iOS by allowing some customization to the Apple Touch UI.

## TODO

* Quick and easy conditional CSS block.
* Simplify calls to `getCurrentPosition` and `watchPosition`.
* Support `autocapitalize` and `autocorrect` form attributes.
* Support client data-storing.

## Installation

	> git submodule add git://github.com/jadb/cakephp-appletouch.git Plugin/AppleTouch

## Configuration

Load the plugin in `bootstrap.php`:

	Plugin::load('AppleTouch');

Add the `AppleTouch.AppleTouch` helper to the controller(s) where you will be using it.

	public $helpers = array('AppleTouch.AppleTouch');

Call it from the view as follow:

	$this->AppleTouch->viewport();

## Patches & Features

* Fork
* Mod, fix
* Test - this is important, so it's not unintentionally broken
* Commit - do not mess with license, todo, version, etc. (if you do change any, bump them into commits of their own that I can ignore when I pull)
* Pull request - bonus point for topic branches

## Bugs & Feedback

[http://github.com/jadb/cakephp-appletouch/issues] [1]

[1]: http://github.com/jadb/cakephp-appletouch/issues
