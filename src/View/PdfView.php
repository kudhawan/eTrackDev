<?php

namespace App\View;

use Cake\Event\EventManager;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\View\View;
use PHPPdf\Core\FacadeBuilder;
use PHPPdf\DataSource\DataSource;

/**
 * View to handle PDF requests
 * using psliwa/php-pdf
 *
 * Covers incoming requests with '.pdf' extension.
 */
class PdfView extends View {

	/**
	 * Controller variables to provide as View class properties
	 *
	 * @var array
	 */
	protected $_passedVars = [
        'autoLayout', 'ext', 'helpers', 'layout',
        'layoutPath', 'name', 'passedArgs',
        'plugin', 'subDir', 'template',
        'templatePath', 'theme', 'view', 'viewVars',
    ];

	/**
	 * View templates subdirectory.
     * /pdf
	 *
	 * @var string
	 */
	public $subDir = null;

	/**
	 * Layout name for this View.
	 *
	 * @var string
	 */
	public $layout = false;

	/**
	 * Constructor
	 *
	 * @param \Cake\Network\Request|null $request Request instance.
	 * @param \Cake\Network\Response|null $response Response instance.
	 * @param \Cake\Event\EventManager|null $eventManager Event manager instance.
	 * @param array $viewOptions View options. cf. $_passedVars
	 */
	public function __construct(
		Request $request = null,
		Response $response = null,
		EventManager $eventManager = null,
		array $viewOptions = []
	) {
		parent::__construct($request, $response, $eventManager, $viewOptions);

		if ($this->subDir === null) {
			$this->subDir = 'pdf';
			$this->templatePath = str_replace(DS . 'pdf', '', $this->templatePath);
		}

		if (isset($response)) {
			$response->type('pdf');
		}

        /**
         * Use a custom extension here, to prevent IDE like PHPStorm
         * to complain about inspections
         */
        $this->_ext = '.xctp';
	}

	/**
	 * Renders a PDF view.
     *
     * Employs Cake\View\View::render() to parse templates,
     * builds the PDF from that result and returns this PDF
	 * with the response object.
	 **
	 * @param string $view Rendering view.
	 * @param string $layout rendering layout.
	 * @return string Rendered view.
	 */
	public function render($view = null, $layout = null) {

        $pathinfo = pathinfo($this->_getViewFileName());
        $stylesheetName = $pathinfo['dirname'] . DS . $pathinfo['filename'] . '.style.xml';

        $content = parent::render($view, $layout);
        $facade = FacadeBuilder::create()->build();

        $stylesheetXml = file_get_contents($stylesheetName);
        $stylesheet = DataSource::fromString($stylesheetXml);
        $content = $facade->render($content, $stylesheet);

        return $content;
	}

}
