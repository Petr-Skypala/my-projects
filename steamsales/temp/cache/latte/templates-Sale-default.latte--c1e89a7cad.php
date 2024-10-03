<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI/templates/Sale/default.latte */
final class Templatec1e89a7cad extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['tag' => '12'], $this->params) as $ʟ_v => $ʟ_l) {
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
<div class="container-sm bg-white vh-100" >
    <h3 class="py-3">';
		echo LR\Filters::escapeHtmlText($heading) /* line 4 */;
		echo '</h3>
    
    <!-- Název výprodeje -->
    <H4 class="d-inline-block py-2 px-3" style="background-color: ';
		echo $sale->color /* line 7 */;
		echo '" >';
		echo LR\Filters::escapeHtmlText($sale->name) /* line 7 */;
		echo '</h4>
    <br>
    <span class="fw-bold d-inline-flex my-3">Tagy: </span>
    
    <!-- Tagy výprodeje -->
';
		$iterations = 0;
		foreach ($tags as $tag) /* line 12 */ {
			echo '	<span class="me-2">';
			echo LR\Filters::escapeHtmlText($tag->tag->name) /* line 13 */;
			echo ' </span>
';
			$iterations++;
		}
		echo '

    <p class="lead">';
		echo LR\Filters::escapeHtmlText($footer) /* line 17 */;
		echo ' </p>

    <!-- JS odpočet -->
    <div id="cdt" class="ms-5"><span id="cdt"></span></div>

    <span class="text-muted">Dnů/hodin/minut/vteřin</span>


<script type="text/javascript">

    var starts = ';
		echo LR\Filters::escapeJs($starts) /* line 27 */;
		echo ';
    var ends = ';
		echo LR\Filters::escapeJs($ends) /* line 28 */;
		echo ';

  $(function(){
	 $("#cdt").countdowntimer({
		 startDate : starts,
		 dateAndTime : ends,
		 displayFormat : "DHMS",
		 size : "lg"
	 });
  });

</script>



</div>';
	}

}
