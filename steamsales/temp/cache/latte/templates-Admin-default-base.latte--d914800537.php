<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI\templates\Admin\default-base.latte */
final class Templated914800537 extends Latte\Runtime\Template
{

	public function main(): array
	{
		extract($this->params);
		echo "\n";
		$form = $this->global->formsStack[] = is_object($ʟ_tmp = $form) ? $ʟ_tmp : $this->global->uiControl[$ʟ_tmp] /* line 2 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo '<form id ="filtrForm" class=form';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), ['id' => null, 'class' => null], false);
		echo '>
';
		ob_start(function () {});
		try {
			echo '	<ul class="errors">
';
			ob_start();
			try {
				$iterations = 0;
				foreach ($form->getOwnErrors() as $error) /* line 4 */ {
					echo '		<li>';
					echo LR\Filters::escapeHtmlText($error) /* line 4 */;
					echo '</li>
';
					$iterations++;
				}
			} finally {
				$ʟ_ifc[1] = rtrim(ob_get_flush()) === '';
			}
			echo '	</ul>
';
		} finally {
			if ($ʟ_ifc[1] ?? null) {
				ob_end_clean();
			} else {
				echo ob_get_clean();
			}
		}
		echo '        
        <div class="input-group">
            <!-- Vykreslí prvky formuláře vč. tlačítek -->
';
		$iterations = 0;
		foreach ($form->getControls() as $input) /* line 9 */ {
			echo '                    
                    ';
			$ʟ_input = is_object($ʟ_tmp = $input) ? $ʟ_tmp : end($this->global->formsStack)[$ʟ_tmp];
			if ($ʟ_label = $ʟ_input->getLabel()) echo $ʟ_label;
			echo '
                    ';
			$ʟ_input = $_input = is_object($ʟ_tmp = $input) ? $ʟ_tmp : end($this->global->formsStack)[$ʟ_tmp];
			echo $ʟ_input->getControl() /* line 12 */;
			echo '
                    ';
			$ʟ_input = is_object($ʟ_tmp = $input) ? $ʟ_tmp : end($this->global->formsStack)[$ʟ_tmp];
			echo LR\Filters::escapeHtmlText($ʟ_input->getError()) /* line 13 */;
			echo "\n";
			$iterations++;
		}
		echo '
        </div>


';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false) /* line 2 */;
		echo '</form>


';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['error' => '4', 'input' => '9'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
