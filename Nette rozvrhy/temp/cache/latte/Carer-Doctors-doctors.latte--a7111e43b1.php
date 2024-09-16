<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Carer\Doctors/doctors.latte */
final class Template_a7111e43b1 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Carer\\Doctors/doctors.latte';

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
			foreach (array_intersect_key(['carer_id' => '7', 'items' => '7', 'item' => '21'], $this->params) as $ʟ_v => $ʟ_l) {
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
    <!-- Seskupí návštěvy u lékařů podle id pečovatelky -->
';
		foreach (($this->filters->group)($doctors, 'carer_id') as $carer_id => $items) /* line 7 */ {
			echo '        <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$carer_id])) /* line 8 */;
			echo '" class="link-dark text-decoration-none">   <h5>';
			echo LR\Filters::escapeHtmlText($carers[$carer_id]->last_name) /* line 8 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($carers[$carer_id]->first_name) /* line 8 */;
			echo '</h5></a>                        
        <div class="row">
            <div class="col-1">
 
            </div>
            <div class="col-6">
                <table class="table table-striped">
                    <tr>
                        <th style="width: 180px">Den</th>
                        <th style="width: 200px">Čas od</th>
                        <th style="width: 200px">Čas do</th>
                    </tr>
                        <!-- Vypíše všechny doktory pečovatelky -->
';
			foreach (($this->filters->sort)(($this->filters->sort)($items, by: 'time_from'), by: 'day_order') as $item) /* line 21 */ {
				echo '                            <tr>
                                <td>';
				echo LR\Filters::escapeHtmlText($item->day) /* line 23 */;
				echo '</td>
                                <td>';
				echo LR\Filters::escapeHtmlText($item->time_from) /* line 24 */;
				echo '</td>
                                <td>';
				echo LR\Filters::escapeHtmlText($item->time_to) /* line 25 */;
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
		echo '    <h4>Návštěvy u lékařů</h4>
';
	}
}
