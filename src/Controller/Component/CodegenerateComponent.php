<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class CodegenerateComponent extends Component
{
	public function generate($code = 'GEN', $count = 0) {
		$count = $count+1;
		return $code.''.$count;
	}
}

?>