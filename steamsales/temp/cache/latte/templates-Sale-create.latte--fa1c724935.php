<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI/templates/Sale/create.latte */
final class Templatefa1c724935 extends Latte\Runtime\Template
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
    <h4 class="py-3">Vložit nový výprodej</h4>
';
		/* line 5 */ $_tmp = $this->global->uiControl->getComponent("newSaleForm");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '</div>

';
	}

}
