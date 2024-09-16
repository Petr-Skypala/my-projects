<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Client\List/float.latte */
final class Template_30151775a2 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Client\\List/float.latte';

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
			foreach (array_intersect_key(['client_id' => '6', 'listItems' => '6', 'service_id' => '20', 'serviceItems' => '20', 'item' => '26', 'service_carers_id' => '28', 'listCarers' => '28', 'carer' => '30'], $this->params) as $ʟ_v => $ʟ_l) {
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
		foreach (($this->filters->group)($list, 'client_id') as $client_id => $listItems) /* line 6 */ {
			echo '        <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$client_id])) /* line 7 */;
			echo '" class="link-dark text-decoration-none">   <h5>';
			echo LR\Filters::escapeHtmlText($clients[$client_id]->last_name) /* line 7 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($clients[$client_id]->first_name) /* line 7 */;
			echo '</h5></a>                        
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th style="width: 200px">Název</th>
                        <th style="width: 120px">Začátek od</th>
                        <th style="width: 120px">Začátek do</th>
                        <th style="width: 120px">Délka min</th>
                        <th style="width: 320px">Vybrané dny</th>
                        <th>Pečovatelky</th>
                    </tr>    
                    
';
			foreach (($this->filters->group)($listItems, 'service_id') as $service_id => $serviceItems) /* line 20 */ {
				echo '                            <tr>
                                <td>';
				echo LR\Filters::escapeHtmlText($services[$service_id]->title) /* line 22 */;
				echo ' </td>
                                <td>';
				echo LR\Filters::escapeHtmlText($services[$service_id]->float_from) /* line 23 */;
				echo ' </td>
                                <td>';
				echo LR\Filters::escapeHtmlText($services[$service_id]->float_to) /* line 24 */;
				echo ' </td>
                                <td>';
				echo LR\Filters::escapeHtmlText($services[$service_id]->float_lenght) /* line 25 */;
				echo ' </td>
                                <td>';
				foreach (($this->filters->sort)($serviceItems, by: 'day_order') as $item) /* line 26 */ {
					echo '<span class="me-3">';
					echo LR\Filters::escapeHtmlText($item->float_days) /* line 26 */;
					echo '</span>';
				}

				echo '</td>
                                <td>
';
				foreach (($this->filters->group)($carers, 'service_id') as $service_carers_id => $listCarers) /* line 28 */ {
					echo '                                        
';
					foreach ($listCarers as $carer) /* line 30 */ {
						if ($service_carers_id == $service_id) /* line 30 */ {
							echo '                                    <span class="me-3"> ';
							echo LR\Filters::escapeHtmlText($carer->last_name) /* line 30 */;
							echo '</span>
';
						}

					}

					echo '                                    
';

				}

				echo '                                </td>
                            </tr>
';

			}

			echo '
                    
                    
                </table>
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
		echo '    <h4>Přehled - plovoucí služby</h4>
';
	}
}
