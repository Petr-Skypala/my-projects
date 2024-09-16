<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI\Carer\Edit/edit.latte */
final class Template_5c4d61dc59 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI\\Carer\\Edit/edit.latte';

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

		echo '<!-- Pečovatelky -->

';
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['carer' => '12', 'doctor' => '72'], $this->params) as $ʟ_v => $ʟ_l) {
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
		foreach ($carers as $carer) /* line 12 */ {
			echo '                        <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$carer->id])) /* line 13 */;
			echo '" class="list-group-item list-group-item-action ';
			if ($carer->id == $actualId) /* line 13 */ {
				echo 'active';
			}
			echo ' "  aria-current="true">';
			echo LR\Filters::escapeHtmlText($carer->last_name) /* line 13 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($carer->first_name) /* line 13 */;
			echo '</a>
';

		}

		echo '                </div>
            </div>
                
            <!-- Formuláře -->
            <div class="col-10">
                <h4>Základní údaje</h4>
                <div class="row">

                    <div class="col-md-6" id="" >
';
		$ʟ_tmp = $this->global->uiControl->getComponent('editForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 24 */;

		echo '

                    </div>
                    <div class="col-md-6" id="" >
';
		$ʟ_tmp = $this->global->uiControl->getComponent('addressForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 29 */;

		echo '                    </div>
                </div>
                <div class="mb-4">
                    <hr class="my-0 py-0">
                </div>
                    
                <!-- Pracovní doby -->
                <div class="mb-3" id="" >
                    <h4>Pracovní doba</h4>
                    <div class="d-flex">

                        <div class="text-nowrap">
                            <ul class="list-unstyled fw-bold">
                                <li class="my-1">Den:</li>
                                <li class="mb-1">Čas od:</li>
                                <li class="mb-2">Čas do:</li>
                                <li class="mb-1">Denní úvazek:</li>

                            </ul>
                        </div>
';
		$ʟ_tmp = $this->global->uiControl->getComponent('mondayForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 50 */;

		$ʟ_tmp = $this->global->uiControl->getComponent('tuesdayForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 51 */;

		$ʟ_tmp = $this->global->uiControl->getComponent('wednesdayForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 52 */;

		$ʟ_tmp = $this->global->uiControl->getComponent('thursdayForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 53 */;

		$ʟ_tmp = $this->global->uiControl->getComponent('fridayForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 54 */;

		echo '
                    </div>
                        <hr class="my-0 py-0">
                </div>
                
                <!-- Doktoří -->
                <div class="row">

                    <div class="col-md-6" id="" >
                        <h4>Návštěvy u lékaře</h4>
';
		$ʟ_tmp = $this->global->uiControl->getComponent('doctorsForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 65 */;

		echo '                    </div>
                    <div class="col-md-6" id="" >
                        <h5>Tento týden:</h5>
                        <table class="table table-hover table-sm table-bordered">
                            <tbody>
';
		if ($doctors) /* line 71 */ {
			foreach ($doctors as $doctor) /* line 72 */ {
				echo '                                    <tr>
                                        <td>';
				echo LR\Filters::escapeHtmlText($doctor->day) /* line 74 */;
				echo '</td>
                                        <td>';
				echo LR\Filters::escapeHtmlText($doctor->time_from) /* line 75 */;
				echo '</td>
                                        <td>';
				echo LR\Filters::escapeHtmlText($doctor->time_to) /* line 76 */;
				echo '</td>
                                        <td><a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:deleteDoctor', ['id' => $doctor->id])) /* line 77 */;
				echo '">Smazat</a></td>
                                    </tr>

';

			}

		}
		echo '                            </tbody>
                        </table>

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
