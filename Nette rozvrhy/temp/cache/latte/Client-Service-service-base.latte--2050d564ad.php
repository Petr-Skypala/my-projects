<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Client\Service\service-base.latte */
final class Template_2050d564ad extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Client\\Service\\service-base.latte';


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
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), ['id' => null, 'class' => null], false) /* line 2 */;
		echo ' id="serviceForm" class=form>
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
            <!-- Vykreslí prvky formuláře kromě tlačítek -->
';
		foreach ($form->getControls() as $input) /* line 9 */ {
			if ($input->getOption('type') !== 'hidden' && $input->getOption('type') !== 'button') /* line 10 */ {
				echo '            <div  class="mb-3 ';
				echo LR\Filters::escapeHtmlAttr($input->getOption('div')) /* line 9 */;
				echo ' ">
                    ';
				echo ($ʟ_label = Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getLabel()) /* line 11 */;
				echo '
                    ';
				echo Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getControl() /* line 12 */;
				echo '
                    ';
				echo LR\Filters::escapeHtmlText(Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getError()) /* line 13 */;
				echo '
            </div>
';
			}

		}

		echo '
            <!-- V případě plovoucí služby -->
';
		if ($float == 1) /* line 17 */ {
			echo '            <div class="col-4">   
                <h6 class="pt-1">Vybrané dny:</h6>
                <table  class="table table-bordered">
                    <tr>
                        <td>';
			foreach ($floatDays as $item) /* line 21 */ {
				echo '<span class="me-3" >';
				echo LR\Filters::escapeHtmlText($item->float_days) /* line 21 */;
				echo '</span>';
			}

			echo '</td>
                    </tr>
                </table>
            </div>
';
		}
		echo '
            <div class="w-100"></div>
            
            <!-- Tlačítka -->
';
		foreach ($form->getControls() as $input) /* line 29 */ {
			if ($input->getOption('type') !== 'hidden' && $input->getOption('type') == 'button') /* line 30 */ {
				echo '            <div class="mb-3 ';
				echo LR\Filters::escapeHtmlAttr($input->getOption('div')) /* line 29 */;
				echo ' ">

                    ';
				echo ($ʟ_label = Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getLabel()) /* line 32 */;
				echo '
                    ';
				echo Nette\Bridges\FormsLatte\Runtime::item($input, $this->global)->getControl() /* line 33 */;
				echo '

            </div>
';
			}

		}

		echo '            <div class="col-2 mb-3">
                <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$form['client_id']->value])) /* line 37 */;
		echo '" class="btn btn-sm btn-outline-secondary" >Zpět na klienta</a>
            </div>
        
        </div>


';
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
			foreach (array_intersect_key(['error' => '4', 'input' => '9, 29', 'item' => '21'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
