<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp\htdocs\rozvrhy\app\UI/@layout.latte */
final class Template_96bfa80fb9 extends Latte\Runtime\Template
{
	public const Source = 'C:\\xampp\\htdocs\\rozvrhy\\app\\UI/@layout.latte';

	public const Blocks = [
		['scripts' => 'blockScripts'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<!DOCTYPE html>
<html lang="cs-cz">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 6 */;
		echo '/bootstrap/css/bootstrap.css">
	<title>';
		if ($this->hasBlock('title')) /* line 7 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('stripHtml', $ʟ_fi, $s));
			}) /* line 7 */;
		}
		echo '</title>
        
        <style>
            form label {
                font-weight: bold;
            }
        </style>
</head>

<body class="">
    <header>

        <!-- Hlavní navigační menu -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#obsah-navigacni-listy" aria-controls="obsah-navigacni-listy" aria-expanded="false" aria-label="Rozbalit navigaci">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-around" id="obsah-navigacni-listy">
                <ul class="navbar-nav nav-pills ms-5 ">
                    <li class="nav-item"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':Home:default')) /* line 28 */;
		echo '" class="nav-link text-white ';
		if (($this->global->fn->isLinkCurrent)($this, ':Home:*')) /* line 28 */ {
			echo 'active';
		}
		echo ' ">Home</a></li>

';
		if ($user->isAllowed('carers', 'view')) /* line 30 */ {
			echo '                    <li class="nav-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':Carer:Edit:edit')) /* line 31 */;
			echo '" class="nav-link text-white ';
			if (($this->global->fn->isModuleCurrent)($this, 'Carer')) /* line 31 */ {
				echo 'active';
			}
			echo '">Pečovatelky</a></li>
';
		}
		echo '
                </ul>


                <div class="d-flex">
                <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-2" type="search" placeholder="Vyhledat..." aria-label="Vyhledávání">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Vyhledat</button>
                </form>
                <ul class="navbar-nav ms-5">
';
		if ($user->isLoggedIn()) /* line 43 */ {
			echo '                    <li class="nav-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':User:Sign:out')) /* line 44 */;
			echo '" class="nav-link text-white ">Odhlásit</a></li>
';
		} else /* line 45 */ {
			echo '                    <li class="nav-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':User:Sign:in')) /* line 46 */;
			echo '" class="nav-link text-white">Přihlásit</a></li>
';
		}
		echo '                </ul>
                </div>   

            </div>
        </nav> 

        <!-- Navigační menu pro pečovatelky -->
';
		if (($this->global->fn->isModuleCurrent)($this, 'Carer')) /* line 55 */ {
			echo '        <div class="container-sm pb-3 bg-light">
            <ul class="nav nav-tabs" id="navigace" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit')) /* line 59 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'Edit:*')) /* line 59 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="editace" aria-selected="true">Editace</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Create:create')) /* line 62 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'Create:*')) /* line 62 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="nová pečovatelka" aria-selected="false">Nová pečovatelka</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('List:list')) /* line 65 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'List:*')) /* line 65 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="podrobný přehled" aria-selected="false">Podrobný přehled</a>
                </li>
            </ul>
        </div>            
';
		}
		echo '            
    </header>
        
        <div class="container-sm">
';
		foreach ($flashes as $flash) /* line 74 */ {
			echo '            <div';
			echo ($ʟ_tmp = array_filter(['alert', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 74 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 74 */;
			echo '</div>
';

		}

		echo '        </div>
        
';
		$this->renderBlock('content', [], 'html') /* line 77 */;
		echo '        
        
';
		$this->renderBlock('scripts', get_defined_vars()) /* line 80 */;
		echo '</body>
</html>
';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['flash' => '74'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block scripts} on line 80 */
	public function blockScripts(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '        
           
	<script src="https://unpkg.com/nette-forms@3"></script>
        <script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 84 */;
		echo '/bootstrap/js/bootstrap.bundle.js"></script>
        <script>
            
        var triggerTabList = [].slice.call(document.querySelectorAll(\'#side-nav a\'))
            triggerTabList.forEach(function (triggerEl) {
              var tabTrigger = new bootstrap.Tab(triggerEl)

              triggerEl.addEventListener(\'click\', function (event) {
                
                this.classList.add(\'active\');
                
              })
              
             
            })
            
            
        </script>
';
	}
}
