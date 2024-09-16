<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Client\Create/create.latte */
final class Template_98eddd97d6 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Client\\Create/create.latte';

	public const Blocks = [
		['content' => 'blockContent', 'title' => 'blockTitle'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<div class="container-sm bg-light vh-100">
';
		$this->renderBlock('title', get_defined_vars()) /* line 4 */;
		echo '    
';
		$ʟ_tmp = $this->global->uiControl->getComponent('createForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 6 */;

		echo '</div>

';
	}


	/** n:block="title" on line 4 */
	public function blockTitle(array $ʟ_args): void
	{
		echo '    <h4>Nový klient</h4>
';
	}
}
