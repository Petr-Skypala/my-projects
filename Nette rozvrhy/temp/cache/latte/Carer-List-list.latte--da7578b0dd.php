<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Carer\List/list.latte */
final class Template_da7578b0dd extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Carer\\List/list.latte';

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


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['carer_id' => '6', 'listItems' => '6', 'item' => '20'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<div class="container-sm bg-light">
';
		$this->renderBlock('title', get_defined_vars()) /* line 4 */;
		echo '    
';
		foreach (($this->filters->group)($list, 'carer_id') as $carer_id => $listItems) /* line 6 */ {
			echo '        <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$carer_id])) /* line 7 */;
			echo '" class="link-dark text-decoration-none">   <h5>';
			echo LR\Filters::escapeHtmlText($carers[$carer_id]->last_name) /* line 7 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($carers[$carer_id]->first_name) /* line 7 */;
			echo '</h5></a>                        
        <div class="row">
            <div class="col-1">
 
            </div>
            <div class="col-6">
                <table class="table table-striped">
                    <tr>
                        <th>Den</th>
                        <th>Čas od</th>
                        <th>Čas do</th>
                        <th>Denní úvazek</th>
                    </tr>
';
			foreach ($listItems as $item) /* line 20 */ {
				echo '                            <tr>
                                <td>';
				echo LR\Filters::escapeHtmlText($item->day) /* line 22 */;
				echo '</td>
                                <td>';
				echo LR\Filters::escapeHtmlText($item->time_from) /* line 23 */;
				echo '</td>
                                <td>';
				echo LR\Filters::escapeHtmlText($item->time_to) /* line 24 */;
				echo '</td>
                                <td>';
				echo LR\Filters::escapeHtmlText($item->day_hours) /* line 25 */;
				echo '</td>
                            </tr>
';

			}

			echo '                </table>
            </div>
        </div>
';

		}

		echo '
</div>


';
	}


	/** n:block="title" on line 4 */
	public function blockTitle(array $ʟ_args): void
	{
		echo '    <h4>Podrobný přehled - pracovní doby</h4>
';
	}
}
