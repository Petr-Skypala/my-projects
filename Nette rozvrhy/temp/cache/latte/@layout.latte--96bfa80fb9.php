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
            
            .alert {
                margin-bottom: 0;
                
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
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':Home:default')) /* line 33 */;
		echo '" class="nav-link text-white ';
		if (($this->global->fn->isLinkCurrent)($this, ':Home:*')) /* line 33 */ {
			echo 'active';
		}
		echo ' ">Home</a></li>

';
		if ($user->isAllowed('carers', 'view')) /* line 35 */ {
			echo '                    <li class="nav-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':Carer:Edit:edit')) /* line 36 */;
			echo '" class="nav-link text-white ';
			if (($this->global->fn->isModuleCurrent)($this, 'Carer')) /* line 36 */ {
				echo 'active';
			}
			echo '">Pečovatelky</a></li>
';
		}
		if ($user->isAllowed('clients', 'view')) /* line 38 */ {
			echo '                    <li class="nav-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':Client:Edit:edit')) /* line 39 */;
			echo '" class="nav-link text-white ';
			if (($this->global->fn->isModuleCurrent)($this, 'Client')) /* line 39 */ {
				echo 'active';
			}
			echo '">Klienti</a></li>
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
		if ($user->isLoggedIn()) /* line 51 */ {
			echo '                    <li class="nav-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':User:Sign:out')) /* line 52 */;
			echo '" class="nav-link text-white ">Odhlásit</a></li>
';
		} else /* line 53 */ {
			echo '                    <li class="nav-item"><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(':User:Sign:in')) /* line 54 */;
			echo '" class="nav-link text-white">Přihlásit</a></li>
';
		}
		echo '                </ul>
                </div>   

            </div>
        </nav> 

        <!-- Navigační menu pro pečovatelky -->
';
		if (($this->global->fn->isModuleCurrent)($this, 'Carer')) /* line 63 */ {
			echo '        <div class="container-sm pb-3 bg-light">
            <ul class="nav nav-tabs" id="navigace" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit')) /* line 67 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'Edit:*')) /* line 67 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="editace" aria-selected="true">Editace</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('List:list')) /* line 70 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'List:*')) /* line 70 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="podrobný přehled" aria-selected="false">Podrobný přehled</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Doctors:doctors')) /* line 73 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'Doctors:*')) /* line 73 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="podrobný přehled" aria-selected="false">Návštěvy u lékařů</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Create:create')) /* line 76 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'Create:*')) /* line 76 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="nová pečovatelka" aria-selected="false">Nová pečovatelka</a>
                </li>
            </ul>
        </div>            
        ';
		}
		echo ' <!-- Pečovatelky -->

        <!-- Navigační menu pro klienti -->
';
		if (($this->global->fn->isModuleCurrent)($this, 'Client')) /* line 83 */ {
			echo '        <div class="container-sm pb-3 bg-light">
            <ul class="nav nav-tabs" id="navigace" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit')) /* line 87 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'Edit:*') || ($this->global->fn->isLinkCurrent)($this, 'Service:*')) /* line 87 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="editace" aria-selected="true">Editace</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('List:list')) /* line 90 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'List:list')) /* line 90 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="podrobný přehled" aria-selected="false">Fixní služby</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('List:float')) /* line 93 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'List:float')) /* line 93 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="podrobný přehled" aria-selected="false">Plovoucí služby</a>
                </li>
                <li class="nav-item">
                    <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Create:create')) /* line 96 */;
			echo '" class="nav-link ';
			if (($this->global->fn->isLinkCurrent)($this, 'Create:*')) /* line 96 */ {
				echo 'active';
			}
			echo '" role="tab" aria-controls="podrobný přehled" aria-selected="false">Nový klient</a>
                </li>
            </ul>
        </div>            
        ';
		}
		echo ' <!-- Klienti -->

        
            
    </header>
        
        <div class="container-sm bg-light">
';
		foreach ($flashes as $flash) /* line 107 */ {
			echo '            <div';
			echo ($ʟ_tmp = array_filter(['alert', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 107 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 107 */;
			echo '</div>
';

		}

		echo '        </div>
        
';
		$this->renderBlock('content', [], 'html') /* line 110 */;
		echo '        
        
';
		$this->renderBlock('scripts', get_defined_vars()) /* line 113 */;
		echo '</body>
</html>
';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['flash' => '107'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block scripts} on line 113 */
	public function blockScripts(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '        
           
	<script src="https://unpkg.com/nette-forms@3"></script>
        <script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 117 */;
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
