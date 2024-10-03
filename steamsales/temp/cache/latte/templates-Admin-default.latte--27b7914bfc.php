<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI/templates/Admin/default.latte */
final class Template27b7914bfc extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['item' => '21'], $this->params) as $ʟ_v => $ʟ_l) {
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
	
    <div class="d-flex justify-content-between align-items-center">
	<h4 class="py-3">Administrace výprodejů</h4>

	<!-- Formulář pro filtrování -->
';
		$this->createTemplate("default-base.latte", ['form' => 'filtrForm'] + $this->params, 'include')->renderToContentType('html') /* line 9 */;
		echo '	
    </div>
    <table class="table table-striped ">
	<tr>
	    <th>Název</th>
	    <th>Začíná</th>
	    <th>Končí</th>
	    <th>Vložil</th>
	    <th>Založený</th>
	</tr>
	<!-- Vypíše všechny výprodeje -->
';
		$iterations = 0;
		foreach (($sales) as $item) /* line 21 */ {
			echo '	    <tr>
		<td><a class="text-decoration-none text-primary" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Edit:edit", [$item->id])) /* line 23 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($item->name) /* line 23 */;
			echo '</a></td>
		<td>';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($item->starts, 'j. n. Y')) /* line 24 */;
			echo '</td>
		<td>';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($item->ends, 'j. n. Y')) /* line 25 */;
			echo '</td>
		<td>';
			echo LR\Filters::escapeHtmlText($item->user->first_name) /* line 26 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($item->user->last_name) /* line 26 */;
			echo '</td>
		<td>';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($item->created_at, 'j. n. Y')) /* line 27 */;
			echo '</td>
	    </tr>
';
			$iterations++;
		}
		echo '    </table>

    <!-- Stránkování -->
    <ul class="pagination pagination-sm pt-3">
	    <li class="page-item"> <a class="page-link ';
		if (!($page > 1)) /* line 34 */ {
			echo 'disabled';
		}
		echo '"  href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [1])) /* line 34 */;
		echo '">&laquo</a></li>
	    <li class="page-item"><a class="page-link ';
		if (!($page > 1)) /* line 35 */ {
			echo 'disabled';
		}
		echo '" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [$page - 1])) /* line 35 */;
		echo '"><</a></li>

	    <li class="page-item"><span class="page-link"> Stránka ';
		echo LR\Filters::escapeHtmlText($page) /* line 37 */;
		echo ' z ';
		echo LR\Filters::escapeHtmlText($lastPage) /* line 37 */;
		echo '</span></li>

	    <li class="page-item"> <a class="page-link ';
		if (!($page < $lastPage)) /* line 39 */ {
			echo 'disabled';
		}
		echo '" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [$page + 1])) /* line 39 */;
		echo '">></a></li>
	    <li class="page-item"> <a class="page-link ';
		if (!($page < $lastPage)) /* line 40 */ {
			echo 'disabled';
		}
		echo '" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [$lastPage])) /* line 40 */;
		echo '">&raquo</a></li>
    </ul>
    
</div>';
	}

}
