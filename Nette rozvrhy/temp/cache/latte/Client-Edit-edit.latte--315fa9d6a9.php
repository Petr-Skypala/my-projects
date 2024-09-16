<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Client\Edit/edit.latte */
final class Template_315fa9d6a9 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Client\\Edit/edit.latte';

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

		echo '<!-- Klienti -->

';
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['client' => '12', 'service' => '59'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
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

        <div class="row mb-5">
            <!-- Postranní navigace -->
            <div class="col-2 vh-100 overflow-auto">
                <div class="list-group" id="side-nav">
';
		foreach ($clients as $client) /* line 12 */ {
			echo '                        <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$client->id])) /* line 13 */;
			echo '" class="list-group-item list-group-item-action ';
			if ($client->id == $actualId) /* line 13 */ {
				echo 'active';
			}
			echo ' "  aria-current="true">';
			echo LR\Filters::escapeHtmlText($client->last_name) /* line 13 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($client->first_name) /* line 13 */;
			echo '</a>
';

		}

		echo '                </div>
            </div>
                
            <!-- Formuláře -->
            <div class="col-10">
                
                <div class="row">

                    <div class="col-md-6" id="" >
                        <h4 class="pt-3">Základní údaje</h4>
';
		$ʟ_tmp = $this->global->uiControl->getComponent('editForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 25 */;

		echo '

                    </div>
                        
                        

                    <div class="col-md-6" id="" >
                        <h4 class="pt-3">Adresy</h4>
';
		$ʟ_tmp = $this->global->uiControl->getComponent('addressForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 34 */;

		echo '                    </div>   

                </div>         
                    
                    
                <div class="mb-4">
                    <hr class="my-0 py-0">
                </div>
                <div class="row">

                    <div class="col-md-10" id="" >

                        <div class="d-flex justify-content-between mb-3">
                        <h4>Seznam služeb</h4>
                        <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Service:create', [$actualId])) /* line 49 */;
		echo '" class="btn btn-outline-secondary mb-0 ">Vložit novou službu</a>
                        </div>

                        <table class="table table-striped">
                            <tr>
                                <th>Den</th>
                                <th>Název</th>
                                <th>Čas od</th>
                                <th>Čas do</th>
                            </tr>
';
		foreach ($services as $service) /* line 59 */ {
			echo '                                <tr>
                                    <td>';
			echo LR\Filters::escapeHtmlText($service->day) /* line 61 */;
			echo '</td>
                                    <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Service:edit', [$service->id])) /* line 62 */;
			echo '"> ';
			echo LR\Filters::escapeHtmlText($service->title) /* line 62 */;
			echo '</a></td>
                                    <td>';
			echo LR\Filters::escapeHtmlText($service->time_from) /* line 63 */;
			echo '</td>
                                    <td>';
			echo LR\Filters::escapeHtmlText($service->time_to) /* line 64 */;
			echo '</td>
                                </tr>
                                
';

		}

		echo '                        </table>


                    </div>
                        
                        


                </div>         
                    


            </div>
                        
        </div>

</div>';
	}


	/** {block title} on line 4 */
	public function blockTitle(array $ʟ_args): void
	{
		echo '<h1 class="d-none">Editace</h1>';
	}
}
