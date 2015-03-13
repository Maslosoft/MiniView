<!--header-->
<!-- Auto generated do not modify between `header` and `/header` -->

# <a href="http://maslosoft.com/miniview/">Maslosoft Miniview</a>
<a href="http://maslosoft.com/miniview/">_Mini view is minimal template rendering library based on Yii controller renderer_</a>

<a href="https://packagist.org/packages/maslosoft/miniview" title="Latest Stable Version">
<img src="https://poser.pugx.org/maslosoft/miniview/v/stable.svg" alt="Latest Stable Version" style="height: 20px;"/>
</a>
<a href="https://packagist.org/packages/maslosoft/miniview" title="License">
<img src="https://poser.pugx.org/maslosoft/miniview/license.svg" alt="License" style="height: 20px;"/>
</a>

### Quick Install
```bash
	composer require maslosoft/miniview:"*"
```

<!--/header-->

## Usage

	namespace Company\SomeNamespace;

	use Maslosoft\MiniView;

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

### Run example

Go to examples folder and type `php run.php`