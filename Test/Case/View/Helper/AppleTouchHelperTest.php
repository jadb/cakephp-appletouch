<?php
App::uses('Controller', 'Controller');
App::uses('AppleTouchHelper', 'AppleTouch.View/Helper');
class HtmlTestController extends Controller {
	public $name = 'Html';
	public $uses = null;
}
class AppleTouchHelperTest extends CakeTestCase {
	public function setUp() {
		$this->View = $this->getMock('View', array('addScript'), array(new HtmlTestController()));
		$this->AppleTouch = new AppleTouchHelper($this->View);
	}
	public function tearDown() {
		unset($this->View, $this->AppleTouch);
	}
	public function testInstanceOf() {
		$this->assertIsA($this->AppleTouch, 'AppleTouchHelper');
	}
	public function testIcons() {
		$expected = '<link href="path-to-57.png" rel="apple-touch-icon" sizes="57x57"/>';
		$result = $this->AppleTouch->icons(array('57x57' => 'path-to-57.png'));
		$this->assertEqual($result, $expected);

		$expected = '<link href="apple-touch-icon-57.png" rel="apple-touch-icon-precomposed" sizes="57x57"/>' . "\n";
		$expected .= '<link href="apple-touch-icon-72.png" rel="apple-touch-icon-precomposed" sizes="72x72"/>' . "\n";
		$expected .= '<link href="apple-touch-icon-114.png" rel="apple-touch-icon-precomposed" sizes="114x114"/>' . "\n";
		$expected .= '<link href="apple-touch-icon-144.png" rel="apple-touch-icon-precomposed" sizes="144x144"/>';
		$result = $this->AppleTouch->icons(array(), true);
		$this->assertEqual($result, $expected);
	}
	public function testSafariUI() {
		$expected = '<meta name="apple-mobile-web-app-capable" content="yes" />';
		$result = $this->AppleTouch->safariUI();
		$this->assertEqual($result, $expected);

		$expected = '<meta name="apple-mobile-web-app-capable" content="no" />';
		$result = $this->AppleTouch->safariUI(true);
		$this->assertEqual($result, $expected);
	}
	public function testStartupImage() {
		$expected = '<link href="apple-touch-startup.png" rel="apple-touch-startup-image"/>';
		$result = $this->AppleTouch->startupImage();
		$this->assertEqual($result, $expected);

	}
	public function testStatusBar() {
		$expected = '<meta name="apple-mobile-web-app-capable" content="yes" />';
		$expected .= '<meta name="apple-mobile-web-app-status-bar-style" content="black" />';
		$result = $this->AppleTouch->statusBar();
		$this->assertEqual($result, $expected);
	}
	public function testViewport() {
		$expected = '<meta name="viewport" content="height=device-height,initial-scale=1.0,user-scalable=no,width=device-width" />';
		$result = $this->AppleTouch->viewport();
		$this->assertEqual($result, $expected);

		$expected = '<meta name="viewport" content="height=540,initial-scale=1.0,user-scalable=yes,width=920" />';
		$result = $this->AppleTouch->viewport(array('height' => 540, 'user-scalable' => true, 'width' => 920));
		$this->assertEqual($result, $expected);
	}
}
