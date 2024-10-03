<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI/templates/User/default.latte */
final class Template38a7d5e43b extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent', 'title' => 'blockTitle'],
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
			foreach (array_intersect_key(['user' => '20'], $this->params) as $ʟ_v => $ʟ_l) {
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
';
		$this->renderBlock('title', get_defined_vars()) /* line 6 */;
		echo '
	<!-- Formulář pro filtrování -->
';
		$this->createTemplate("default-base.latte", ['form' => 'filtrForm'] + $this->params, 'include')->renderToContentType('html') /* line 9 */;
		echo '
    </div>
	<table class="table table-striped">
	<tr>
	    <th>Jméno</th>
	    <th>Uživatelské jméno</th>
	    <th>Role</th>
	    <th>Aktivní</th>
	</tr>
	    <!-- Vypíše všechny uživatele -->
';
		$iterations = 0;
		foreach (($users) as $user) /* line 20 */ {
			echo '		<tr>
		    <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:edit", [$user->id])) /* line 22 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($user->first_name) /* line 22 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($user->last_name) /* line 22 */;
			echo '</a></td>
		    <td>';
			echo LR\Filters::escapeHtmlText($user->username) /* line 23 */;
			echo '</td>
		    <td>';
			echo LR\Filters::escapeHtmlText($user->role) /* line 24 */;
			echo '</td>
		    <td>';
			echo LR\Filters::escapeHtmlText(($this->filters->replace)(($this->filters->replace)($user->active, '0', 'N'), '1', 'A')) /* line 25 */;
			echo '</td>
		</tr>
';
			$iterations++;
		}
		echo '    </table>
    
    <!-- Stránkování -->
    <ul class="pagination pagination-sm pt-3">

	    <li class="page-item"> <a class="page-link ';
		if (!($page > 1)) /* line 33 */ {
			echo 'disabled';
		}
		echo '"  href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [1])) /* line 33 */;
		echo '">&laquo</a></li>
	    <li class="page-item"><a class="page-link ';
		if (!($page > 1)) /* line 34 */ {
			echo 'disabled';
		}
		echo '" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [$page - 1])) /* line 34 */;
		echo '"><</a></li>

	    <li class="page-item"><span class="page-link"> Stránka ';
		echo LR\Filters::escapeHtmlText($page) /* line 36 */;
		echo ' z ';
		echo LR\Filters::escapeHtmlText($lastPage) /* line 36 */;
		echo '</span></li>

	    <li class="page-item"> <a class="page-link ';
		if (!($page < $lastPage)) /* line 38 */ {
			echo 'disabled';
		}
		echo '" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [$page + 1])) /* line 38 */;
		echo '">></a></li>
	    <li class="page-item"> <a class="page-link ';
		if (!($page < $lastPage)) /* line 39 */ {
			echo 'disabled';
		}
		echo '" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("default", [$lastPage])) /* line 39 */;
		echo '">&raquo</a></li>

    </ul>
    
</div>

';
	}


	/** {block title} on line 6 */
	public function blockTitle(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '	<h4 class="py-3">Seznam uživatelů</h4>
';
	}

}
