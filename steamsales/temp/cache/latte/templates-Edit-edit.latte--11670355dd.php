<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI/templates/Edit/edit.latte */
final class Template11670355dd extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent'],
	];


	public function main(): array
	{
		extract($this->params);
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['tag' => '17'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '
<div class="container-sm bg-white vh-100">
    <h4 class="py-3">Editace výprodeje</h4>
    <div class="row">

	<!-- Formulář výprodeje -->
	<div class="col-4">
';
		/* line 9 */ $_tmp = $this->global->uiControl->getComponent("editSaleForm");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '	</div>

	<!-- Vypíše tagy výprodeje -->
	<div class="col-4">   
	    <h6 class="pt-1">Vybrané tagy:</h6>
	    <table  class="table table-bordered">
		<tr>
		    <td>';
		$iterations = 0;
		foreach ($tags as $tag) /* line 17 */ {
			echo '<span class="me-3 w-100" >';
			echo LR\Filters::escapeHtmlText($tag->tag->name) /* line 17 */;
			echo '</span>';
			$iterations++;
		}
		echo '</td>
		</tr>
	    </table>
	</div>
    </div>
</div>
';
	}

}
