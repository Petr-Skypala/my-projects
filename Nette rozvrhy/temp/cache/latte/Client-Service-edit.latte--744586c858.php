<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Client\Service/edit.latte */
final class Template_744586c858 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Client\\Service/edit.latte';

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
			foreach (array_intersect_key(['carer' => '13', 'item' => '21'], $this->params) as $ʟ_v => $ʟ_l) {
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
<div class="container-sm bg-light vh-100">
';
		$this->renderBlock('title', get_defined_vars()) /* line 4 */;
		echo '    
';
		$this->createTemplate('service-base.latte', ['form' => 'serviceForm'] + $this->params, 'include')->renderToContentType('html') /* line 6 */;
		echo '    <hr>
    <h4>Pečovatelky ke službě</h4>
    <div class="row">
        <!-- Postranní navigace -->
        <div class="col-3 overflow-auto" style="height: 400px">
            <div class="list-group" id="side-nav">
';
		foreach ($carers as $carer) /* line 13 */ {
			echo '                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Carers:add', [$serviceId, $carer->id])) /* line 14 */;
			echo '" class="list-group-item list-group-item-action ">';
			echo LR\Filters::escapeHtmlText($carer->last_name) /* line 14 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($carer->first_name) /* line 14 */;
			echo '</a>
';

		}

		echo '            </div>
        </div>
        <div class="col-9">
            <h5>Přiřazené pečovatelky:</h5>
            <div class="row">
';
		foreach ($serviceCarers as $item) /* line 21 */ {
			echo '                <div  class="p-0 mb-3 col-md-3">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Carers:remove', [$serviceId, $item->id])) /* line 22 */;
			echo '" class="d-block text-center text-primary px-3 py-2 border border-1 border-secondary rounded text-decoration-none"> ';
			echo LR\Filters::escapeHtmlText($item->last_name) /* line 22 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($item->first_name) /* line 22 */;
			echo '</a>
                </div>
';

		}

		echo '            </div>
                <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Carers:addAll', [$serviceId])) /* line 25 */;
		echo '" class="btn btn-outline-secondary m-0">Vložit vše</a>
                <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Carers:removeAll', [$serviceId])) /* line 26 */;
		echo '" class="btn btn-outline-secondary m-0">Odebrat vše</a>
        </div>
            
        
    </div>
</div>


';
	}


	/** n:block="title" on line 4 */
	public function blockTitle(array $ʟ_args): void
	{
		echo '    <h4>Editace služby</h4>
';
	}
}
