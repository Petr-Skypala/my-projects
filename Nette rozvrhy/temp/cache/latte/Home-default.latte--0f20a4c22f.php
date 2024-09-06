<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Home/default.latte */
final class Template_0f20a4c22f extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Home/default.latte';

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

		echo '

';
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		$this->renderBlock('title', get_defined_vars()) /* line 4 */;
		echo '
    <div class="container-sm bg-light vh-100">
        <h4 class="pt-3">Úvodní strana</h4>
        <p class="lead">
            Aplikace na tvorbu rozvrhů
        </p>
    </div>';
	}


	/** {block title} on line 4 */
	public function blockTitle(array $ʟ_args): void
	{
		echo '<h1 class="d-none">Home</h1>';
	}
}
