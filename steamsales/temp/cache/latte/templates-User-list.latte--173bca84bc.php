<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI/templates/User/list.latte */
final class Template173bca84bc extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['user' => '14'], $this->params) as $ʟ_v => $ʟ_l) {
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
';
		$this->renderBlock('title', get_defined_vars()) /* line 4 */;
		echo '
	<table class="table table-striped">
	<tr>
	    <th>Jméno</th>
	    <th>Uživatelské jméno</th>
	    <th>Role</th>
	    <th>Aktivní</th>
	</tr>
	    <!-- Vypíše všechny výprodeje -->
';
		$iterations = 0;
		foreach (($users) as $user) /* line 14 */ {
			echo '		<tr>
		    <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:edit", [$user->id])) /* line 16 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($user->first_name) /* line 16 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($user->last_name) /* line 16 */;
			echo '</a></td>
		    <td>';
			echo LR\Filters::escapeHtmlText($user->username) /* line 17 */;
			echo '</td>
		    <td>';
			echo LR\Filters::escapeHtmlText($user->role) /* line 18 */;
			echo '</td>
		    <td>';
			echo LR\Filters::escapeHtmlText(($this->filters->replace)(($this->filters->replace)($user->active, '0', 'N'), '1', 'A')) /* line 19 */;
			echo '</td>
		</tr>
';
			$iterations++;
		}
		echo '    </table>

    
</div>

';
	}


	/** {block title} on line 4 */
	public function blockTitle(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '    <h4 class="py-3">Seznam uživatelů</h4>
';
	}

}
