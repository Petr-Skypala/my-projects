<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\xampp74\htdocs\steamsales\app\UI/templates/@layout.latte */
final class Template2368d1e03b extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['scripts' => 'blockScripts'],
	];


	public function main(): array
	{
		extract($this->params);
		echo '<!DOCTYPE html>
<html>
<head>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 9 */;
		echo '/bootstrap/css/bootstrap.css">
<title>';
		if ($this->hasBlock("title")) /* line 10 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('stripHtml', $ʟ_fi, $s));
			}) /* line 10 */;
		}
		echo '</title>

<!-- Vložené skripty pro odpočet času -->
<script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 13 */;
		echo '/jQuery/jquery-3.7.1.js"></script>
<script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 14 */;
		echo '/jQuery/jQuery.countdownTimer.js"></script>


</head>

<body class="bg-light">
    <header>
        <!-- Hlavní navigační menu -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">

 
            <div class="navbar-collapse justify-content-around" id="obsah-navigacni-listy">
                <ul class="navbar-nav nav-pills ms-5 ">

';
		if (!$user->isLoggedIn()) /* line 28 */ {
			echo '                    <li class="nav-item"><a class="nav-link text-white ';
			if (($this->global->fn->isLinkCurrent)(':Front:Sale:*')) /* line 29 */ {
				echo 'active';
			}
			echo ' " href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Front:Sale:default")) /* line 29 */;
			echo '">Výprodej</a></li>
';
		}
		if ($user->isLoggedIn()) /* line 31 */ {
			echo '		    <li class="nav-item"><a class="nav-link text-white ';
			if (($this->global->fn->isLinkCurrent)(':Admin:Admin:*')) /* line 32 */ {
				echo 'active';
			}
			echo ' " href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Admin:default")) /* line 32 */;
			echo '">Administrace</a></li>
		    <li class="nav-item"><a class="nav-link text-white ';
			if (($this->global->fn->isLinkCurrent)(':Admin:Sale:*')) /* line 33 */ {
				echo 'active';
			}
			echo ' " href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Sale:create")) /* line 33 */;
			echo '">Vložit nový výprodej</a></li>
';
			if ($user->isAllowed('users', 'edit')) /* line 34 */ {
				echo '		    <li class="nav-item"><a class="nav-link text-white ';
				if (($this->global->fn->isLinkCurrent)(':User:User:default')) /* line 35 */ {
					echo 'active';
				}
				echo ' " href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":User:User:default")) /* line 35 */;
				echo '">Uživatelé</a></li>
		    <li class="nav-item"><a class="nav-link text-white ';
				if (($this->global->fn->isLinkCurrent)(':User:User:create')) /* line 36 */ {
					echo 'active';
				}
				echo ' " href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":User:User:create")) /* line 36 */;
				echo '">Nový uživatel</a></li>
';
			}
		}
		echo '                </ul>


                <div class="d-flex">
                <ul class="navbar-nav ms-5">
';
		if ($user->isLoggedIn()) /* line 44 */ {
			echo '                    <li class="nav-item"><a class="nav-link text-white " href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":User:Sign:out")) /* line 45 */;
			echo '">Odhlásit</a></li>
';
		} else /* line 46 */ {
			echo '                    <li class="nav-item"><a class="nav-link text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":User:Sign:in")) /* line 47 */;
			echo '">Přihlásit</a></li>
';
		}
		echo '                </ul>
                </div>   

            </div>
        </nav> 

    </header>
';
		$iterations = 0;
		foreach ($flashes as $flash) /* line 56 */ {
			echo '	<div';
			echo ($ʟ_tmp = array_filter(['alert', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 56 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 56 */;
			echo '</div>
';
			$iterations++;
		}
		echo "\n";
		$this->renderBlock('content', [], 'html') /* line 58 */;
		echo '



';
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('scripts', get_defined_vars()) /* line 62 */;
		echo '
</body>
</html>
';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['flash' => '56'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block scripts} on line 62 */
	public function blockScripts(array $ʟ_args): void
	{
		echo '	<script src="https://unpkg.com/nette-forms@3"></script>

';
	}

}
