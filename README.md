MiniView
========

Mini view is minimal template rendering library


## Install

	composer require maslosoft/miniview *

## Usage

	namespace Company\SomeNamespace;

	use Maslosoft\Addendum\Helpers\MiniView;

	class MyWidget
	{

		/**
		 * View renderer
		 * @var MiniView
		 */
		public $view = null;

		public function __construct()
		{
			$this->view = new MiniView($this);
		}

		public function show()
		{
			return $this->view->render('myView', ['user' => 'Joe'], true);
		}

	}

Calling `show()` will return rendered view file located in `classFolder/views/myView.php` with variable `$user` with value `Joe`