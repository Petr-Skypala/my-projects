<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Client\Service\create-base.latte */
final class Template_96d3c6bd88 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Client\\Service\\create-base.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo "\n";
		$form = $this->global->formsStack[] = is_object($ʟ_tmp = $form) ? $ʟ_tmp : $this->global->uiControl[$ʟ_tmp] /* line 2 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo '<form';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), ['class' => null], false) /* line 2 */;
		echo ' class=form>
';
		ob_start(fn() => '');
		try {
			echo '	<ul class="errors">';
			ob_start();
			try {
				echo "\n";
				foreach ($form->getOwnErrors() as $error) /* line 4 */ {
					echo '		<li>';
					echo LR\Filters::escapeHtmlText($error) /* line 4 */;
					echo '</li>
';

				}

				echo '	';

			} finally {
				$ʟ_ifc[0] = rtrim(ob_get_flush()) === '';
			}
			echo '</ul>
';

		} finally {
			if ($ʟ_ifc[0] ?? null) {
				ob_end_clean();

			} else {
				echo ob_get_clean();
			}
		}
		echo '        
        <div class="row">
';
		foreach ($form->getControls() as $input) /* line 8 */ {
			if ($input->getOption('type') !== 'hidden' && $input->getOption('type') !== 'button' && strpos($input->getOption('div'), 'float') == false) /* line 9 */ {
				echo '	<div  class="mb-3 ';
				echo LR\Filters::escapeHtmlAttr($input->getOption('div')) /* line 8 */;
				echo ' ">
		';
				echo ($ʟ_label = Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getLabel()) /* line 10 */;
				echo '
		';
				echo Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getControl() /* line 11 */;
				echo '
		';
				echo LR\Filters::escapeHtmlText(Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getError()) /* line 12 */;
				echo '
	</div>
';
			}

		}

		foreach ($form->getControls() as $input) /* line 14 */ {
			if ($input->getOption('type') !== 'hidden' && strpos($input->getOption('div'), 'float') !== false && $float == 1) /* line 15 */ {
				echo '	<div  class="mb-3 ';
				echo LR\Filters::escapeHtmlAttr($input->getOption('div')) /* line 14 */;
				echo ' ">
		';
				echo ($ʟ_label = Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getLabel()) /* line 16 */;
				echo '
		';
				echo Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getControl() /* line 17 */;
				echo '
		';
				echo LR\Filters::escapeHtmlText(Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getError()) /* line 18 */;
				echo '
	</div>
';
			}

		}

		echo '        
        
        
        </div>


';
		foreach ($form->getControls() as $input) /* line 26 */ {
			if ($input->getOption('type') !== 'hidden' && $input->getOption('type') == 'button') /* line 27 */ {
				echo '        <div>
      		';
				echo ($ʟ_label = Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getLabel()) /* line 28 */;
				echo '
		';
				echo Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getControl() /* line 29 */;
				echo '

        </div>
';
			}

		}

		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(end($this->global->formsStack), false) /* line 2 */;
		echo '</form>
';
		array_pop($this->global->formsStack);
		echo '

';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['error' => '4', 'input' => '8, 14, 26'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
