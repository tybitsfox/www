<!DOCTYPE html>
<html class="client-nojs" lang="en" dir="ltr">
<head>
<meta charset="UTF-8"/>
<title>Uefi.inc - OSDev Wiki</title>
<script>document.documentElement.className="client-js";RLCONF={"wgBreakFrames":false,"wgSeparatorTransformTable":["",""],"wgDigitTransformTable":["",""],"wgDefaultDateFormat":"dmy","wgMonthNames":["","January","February","March","April","May","June","July","August","September","October","November","December"],"wgRequestId":"e186be0280431f3a270fc728","wgCSPNonce":false,"wgCanonicalNamespace":"","wgCanonicalSpecialPageName":false,"wgNamespaceNumber":0,"wgPageName":"Uefi.inc","wgTitle":"Uefi.inc","wgCurRevisionId":25442,"wgRevisionId":25442,"wgArticleId":3317,"wgIsArticle":true,"wgIsRedirect":false,"wgAction":"view","wgUserName":null,"wgUserGroups":["*"],"wgCategories":["Pages using deprecated source tags","Tone","UEFI","X86"],"wgPageContentLanguage":"en","wgPageContentModel":"wikitext","wgRelevantPageName":"Uefi.inc","wgRelevantArticleId":3317,"wgIsProbablyEditable":false,"wgRelevantPageIsProbablyEditable":false,"wgRestrictionEdit":[],"wgRestrictionMove":[],"wgMFDisplayWikibaseDescriptions":{
"search":false,"nearby":false,"watchlist":false,"tagline":false},"wgVisualEditor":{"pageLanguageCode":"en","pageLanguageDir":"ltr","pageVariantFallbacks":"en"},"wgVector2022PreviewPages":[],"wgMediaViewerOnClick":true,"wgMediaViewerEnabledByDefault":true,"wgEditSubmitButtonLabelPublish":false};RLSTATE={"site.styles":"ready","user.styles":"ready","user":"ready","user.options":"loading","ext.pygments":"ready","skins.vector.styles.legacy":"ready","ext.visualEditor.desktopArticleTarget.noscript":"ready","ext.DarkMode.styles":"ready"};RLPAGEMODULES=["site","mediawiki.page.ready","mediawiki.toc","skins.vector.legacy.js","ext.visualEditor.desktopArticleTarget.init","ext.visualEditor.targetLoader","ext.DarkMode","ext.moderation.notify","ext.moderation.ve","ext.moderation.ajaxhook","ext.moderation.notify.desktop"];</script>
<script>(RLQ=window.RLQ||[]).push(function(){mw.loader.implement("user.options@12s5i",function($,jQuery,require,module){mw.user.tokens.set({"patrolToken":"+\\","watchToken":"+\\","csrfToken":"+\\"});});});</script>
<link rel="stylesheet" href="https://wiki.osdev.org/load.php?lang=en&amp;modules=ext.DarkMode.styles%7Cext.pygments%7Cext.visualEditor.desktopArticleTarget.noscript%7Cskins.vector.styles.legacy&amp;only=styles&amp;skin=vector"/>
<script async="" src="https://wiki.osdev.org/load.php?lang=en&amp;modules=startup&amp;only=scripts&amp;raw=1&amp;skin=vector"></script>
<meta name="ResourceLoaderDynamicStyles" content=""/>
<link rel="stylesheet" href="https://wiki.osdev.org/load.php?lang=en&amp;modules=site.styles&amp;only=styles&amp;skin=vector"/>
<meta name="generator" content="MediaWiki 1.39.7"/>
<meta name="format-detection" content="telephone=no"/>
<meta name="viewport" content="width=1000"/>
<link rel="icon" href="favicon.ico"/>
<link rel="search" type="application/opensearchdescription+xml" href="opensearch_desc.php" title="OSDev Wiki (en)"/>
<link rel="EditURI" type="application/rsd+xml" href="api.php?action=rsd"/>
<link rel="alternate" type="application/atom+xml" title="OSDev Wiki Atom feed" href="https://wiki.osdev.org/index.php?title=Special:RecentChanges&amp;feed=atom"/>
</head>
<body class="mediawiki ltr sitedir-ltr mw-hide-empty-elt ns-0 ns-subject page-Uefi_inc rootpage-Uefi_inc skin-vector action-view skin-vector-legacy vector-feature-language-in-header-enabled vector-feature-language-in-main-page-header-disabled vector-feature-language-alert-in-sidebar-disabled vector-feature-sticky-header-disabled vector-feature-sticky-header-edit-disabled vector-feature-table-of-contents-disabled vector-feature-visual-enhancement-next-disabled"><div id="mw-page-base" class="noprint"></div>
<div id="mw-head-base" class="noprint"></div>
<div id="content" class="mw-body" role="main">
	<a id="top"></a>
	<div id="siteNotice"></div>
	<div class="mw-indicators">
	</div>
	<h1 id="firstHeading" class="firstHeading mw-first-heading"><span class="mw-page-title-main">Uefi.inc</span></h1>
	<div id="bodyContent" class="vector-body">
		<div id="siteSub" class="noprint">From OSDev Wiki</div>
		<div id="contentSub"></div>
		<div id="contentSub2"></div>
		
		<div id="jump-to-nav"></div>
		<a class="mw-jump-link" href="Uefi.inc#mw-head">Jump to navigation</a>
		<a class="mw-jump-link" href="Uefi.inc#searchInput">Jump to search</a>
		<div id="mw-content-text" class="mw-body-content mw-content-ltr" lang="en" dir="ltr"><div class="mw-parser-output"><center style="border: 1px solid #cfcfbf; margin-top: 25px; margin-bottom: 25px; background-color: #f0f0ff; text-align: center;">
<p>This article is written like a tutorial. Please <a rel="nofollow" class="external text" href="https://wiki.osdev.org/index.php?title=Uefi.inc&amp;action=edit">edit</a> it to have more information and documentation instead of example code and step by step instructions.
</p>
</center>
<p><tt>uefi.inc</tt> a library for <a href="UEFI" title="UEFI">UEFI</a> written in assembly for <a href="FASM" title="FASM">FASM</a>. It's main goal was small code, and to achieve that it gives only limited access to UEFI. It was designed to fulfill all the needs of a boot loader, namely
</p>
<ul><li>Provide user input interface.</li>
<li>Exactly one way to load and save sectors.</li>
<li>Framebuffer services for output.</li></ul>
<p>It is not intend to be an universal UEFI library, because you won't need all UEFI functionality in a bootloader, just the ones listed above.
</p>
<div id="toc" class="toc" role="navigation" aria-labelledby="mw-toc-heading"><input type="checkbox" role="button" id="toctogglecheckbox" class="toctogglecheckbox" style="display:none" /><div class="toctitle" lang="en" dir="ltr"><h2 id="mw-toc-heading">Contents</h2><span class="toctogglespan"><label class="toctogglelabel" for="toctogglecheckbox"></label></span></div>
<ul>
<li class="toclevel-1 tocsection-1"><a href="Uefi.inc#Hello_World_from_UEFI"><span class="tocnumber">1</span> <span class="toctext">Hello World from UEFI</span></a></li>
<li class="toclevel-1 tocsection-2"><a href="Uefi.inc#Description"><span class="tocnumber">2</span> <span class="toctext">Description</span></a></li>
<li class="toclevel-1 tocsection-3"><a href="Uefi.inc#Case_studies:_usage_in_a_boot_loader"><span class="tocnumber">3</span> <span class="toctext">Case studies: usage in a boot loader</span></a>
<ul>
<li class="toclevel-2 tocsection-4"><a href="Uefi.inc#Reading_a_character_from_keyboard"><span class="tocnumber">3.1</span> <span class="toctext">Reading a character from keyboard</span></a></li>
<li class="toclevel-2 tocsection-5"><a href="Uefi.inc#Detecting_Memory_Map"><span class="tocnumber">3.2</span> <span class="toctext">Detecting Memory Map</span></a></li>
<li class="toclevel-2 tocsection-6"><a href="Uefi.inc#Iterating_on_disks"><span class="tocnumber">3.3</span> <span class="toctext">Iterating on disks</span></a></li>
<li class="toclevel-2 tocsection-7"><a href="Uefi.inc#Loading_a_sector_from_device"><span class="tocnumber">3.4</span> <span class="toctext">Loading a sector from device</span></a></li>
<li class="toclevel-2 tocsection-8"><a href="Uefi.inc#Get_sorted_list_of_available_video_modes"><span class="tocnumber">3.5</span> <span class="toctext">Get sorted list of available video modes</span></a></li>
</ul>
</li>
<li class="toclevel-1 tocsection-9"><a href="Uefi.inc#The_include_file"><span class="tocnumber">4</span> <span class="toctext">The include file</span></a></li>
</ul>
</div>

<h2><span class="mw-headline" id="Hello_World_from_UEFI">Hello World from UEFI</span></h2>
<p>This shows how to import and use the library. The macro hides UEFI ABI from the programmer, so you don't have to worry about number of arguments, stack alignment and in which registers to pass arguments etc.
</p>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">format</span><span class="w"> </span><span class="no">pe64</span><span class="w"> </span><span class="no">dll</span><span class="w"> </span><span class="no">efi</span><span class="w"></span>
<span class="nf">entry</span><span class="w"> </span><span class="no">main</span><span class="w"></span>

<span class="nf">section</span><span class="w"> </span><span class="err">&#39;</span><span class="no">.text</span><span class="err">&#39;</span><span class="w"> </span><span class="no">code</span><span class="w"> </span><span class="no">executable</span><span class="w"> </span><span class="no">readable</span><span class="w"></span>

<span class="nf">include</span><span class="w"> </span><span class="err">&#39;</span><span class="no">uefi.inc</span><span class="err">&#39;</span><span class="w"></span>

<span class="nl">main:</span><span class="w"></span>
<span class="w">    </span><span class="c1">; initialize UEFI library</span>
<span class="w">    </span><span class="nf">InitializeLib</span><span class="w"></span>
<span class="w">    </span><span class="nf">jc</span><span class="w"> </span><span class="err">@</span><span class="no">f</span><span class="w"></span>

<span class="w">    </span><span class="c1">; call uefi function to print to screen</span>
<span class="w">    </span><span class="nf">uefi_call_wrapper</span><span class="w"> </span><span class="no">ConOut</span><span class="p">,</span><span class="w"> </span><span class="no">OutputString</span><span class="p">,</span><span class="w"> </span><span class="no">ConOut</span><span class="p">,</span><span class="w"> </span><span class="no">_hello</span><span class="w"></span>

<span class="err">@@:</span><span class="w"> </span><span class="nf">mov</span><span class="w"> </span><span class="no">eax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">    </span><span class="nf">retn</span><span class="w"></span>

<span class="nf">section</span><span class="w"> </span><span class="err">&#39;</span><span class="no">.data</span><span class="err">&#39;</span><span class="w"> </span><span class="no">data</span><span class="w"> </span><span class="no">readable</span><span class="w"> </span><span class="no">writeable</span><span class="w"></span>

<span class="nf">_hello</span><span class="w">                                  </span><span class="no">du</span><span class="w"> </span><span class="err">&#39;</span><span class="no">Hello</span><span class="w"> </span><span class="no">World</span><span class="err">&#39;</span><span class="p">,</span><span class="mi">13</span><span class="p">,</span><span class="mi">10</span><span class="p">,</span><span class="mi">0</span><span class="w"></span>

<span class="nf">section</span><span class="w"> </span><span class="err">&#39;</span><span class="no">.reloc</span><span class="err">&#39;</span><span class="w"> </span><span class="no">fixups</span><span class="w"> </span><span class="no">data</span><span class="w"> </span><span class="no">discardable</span><span class="w"></span>
</pre></div>
<h2><span class="mw-headline" id="Description">Description</span></h2>
<p>There's only two functions, as you can see in the Hello World example. The names came from the original <a href="GNU-EFI" title="GNU-EFI">GNU-EFI</a> SDK.
</p>
<ul><li>InitializeLib - initializes the library, you should call this as soon as possible.</li>
<li>uefi_call_wrapper - provides a way to call an UEFI function with it's ABI</li></ul>
<p>Other than these, you need structure definitions (like ConIn) to figure out the actual function addresses. These are also defined in the include file. As said earlier, those definitions are limited to Console, Framebuffer and Storage to keep the include file small.
</p><p>If you want, you can add more structure definitions any time in a separate include file. The uefi_call_wrapper macro allows you to call those, but it also specifies shortcuts for the most common functions, so that you don't have to use BootServices or RuntimeServices prefixes.
</p>
<h2><span class="mw-headline" id="Case_studies:_usage_in_a_boot_loader">Case studies: usage in a boot loader</span></h2>
<p>Please note that these are only tutorials. They focus on a specific topic only. They do not allocate buffers they use for example. You'll have to write that part on your own.
They were written for those who wants to roll their own UEFI boot loader in assembly. I hope it will save them some sleepless nights and headaches.
</p>
<h3><span class="mw-headline" id="Reading_a_character_from_keyboard">Reading a character from keyboard</span></h3>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="err">@@:</span><span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">ConIn</span><span class="p">,</span><span class="w"> </span><span class="no">ReadKeyStroke</span><span class="p">,</span><span class="w"> </span><span class="no">ConIn</span><span class="p">,</span><span class="w"> </span><span class="no">key</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">key.scancode</span><span class="p">],</span><span class="w"> </span><span class="mi">0</span><span class="w"></span>
<span class="w">		</span><span class="nf">jz</span><span class="w">			</span><span class="err">@</span><span class="no">b</span><span class="w"></span>

<span class="c1">;data</span>
<span class="nl">key:</span><span class="w"></span>
<span class="nl">key.scancode:</span><span class="w">	</span><span class="nf">dw</span><span class="w"> 			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">key.unicode:</span><span class="w">	</span><span class="nf">du</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
</pre></div>
<h3><span class="mw-headline" id="Detecting_Memory_Map">Detecting Memory Map</span></h3>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">memmapdescsize</span><span class="p">],</span><span class="w"> </span><span class="mi">48</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">BootServices</span><span class="p">,</span><span class="w"> </span><span class="no">GetMemoryMap</span><span class="p">,</span><span class="w"> </span><span class="no">memmapsize</span><span class="p">,</span><span class="w"> </span><span class="no">memmapbuff</span><span class="p">,</span><span class="w"> </span><span class="no">memmapkey</span><span class="p">,</span><span class="w"> </span><span class="no">memmapdescsize</span><span class="p">,</span><span class="w"> </span><span class="no">memmapdescver</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">memmapdescsize</span><span class="p">],</span><span class="w"> </span><span class="mi">0</span><span class="w"></span>
<span class="w">		</span><span class="nf">jnz</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">memmapdescsize</span><span class="p">],</span><span class="w"> </span><span class="mi">48</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">clc</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">		</span><span class="nf">je</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">stc</span><span class="w"></span>
<span class="err">@@:</span><span class="w"></span>

<span class="c1">;data</span>
<span class="nl">memmapsize:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="no">MEMMAP_BUFFSIZE</span><span class="w"></span>
<span class="nl">memmapkey:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">memmapdescsize:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">memmapdescver:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">memmapbuff:</span><span class="w">	</span><span class="nf">rb</span><span class="w">			</span><span class="no">MEMMAP_BUFFSIZE</span><span class="w"></span>
</pre></div>
<p>Note that memmapkey is needed for ExitBootServices. If you use memory allocation or free, you'll have to query again map to get a valid key.
</p>
<h3><span class="mw-headline" id="Iterating_on_disks">Iterating on disks</span></h3>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="w">		</span><span class="c1">; query device handles</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">],</span><span class="w"> </span><span class="no">DEVICEHANDLE_BUFFSIZE</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">BootServices</span><span class="p">,</span><span class="w"> </span><span class="no">LocateHandle</span><span class="p">,</span><span class="w"> </span><span class="mi">2</span><span class="p">,</span><span class="w"> </span><span class="no">blkiouuid</span><span class="p">,</span><span class="w"> </span><span class="mi">0</span><span class="p">,</span><span class="w"> </span><span class="no">tmp</span><span class="p">,</span><span class="w"> </span><span class="no">devicehandle_buff</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">		</span><span class="nf">jne</span><span class="w">			</span><span class="no">.error</span><span class="w"></span>

<span class="w">		</span><span class="c1">; iterate on handles</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r15</span><span class="p">,</span><span class="w"> </span><span class="no">devicehandle_buff</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r14</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">]</span><span class="w"></span>
<span class="nl">.nexthandle:</span><span class="w">	</span><span class="nf">mov</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">r15</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">or</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">rcx</span><span class="w"></span>
<span class="w">		</span><span class="nf">jz</span><span class="w">			</span><span class="no">.end</span><span class="w"></span>
<span class="w">		</span><span class="c1">; open handle</span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r14</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r15</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">BootServices</span><span class="p">,</span><span class="w"> </span><span class="no">OpenProtocol</span><span class="p">,</span><span class="w"> </span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">blkiouuid</span><span class="p">,</span><span class="w"> </span><span class="no">tmp</span><span class="p">,</span><span class="w"> </span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="mi">0</span><span class="p">,</span><span class="w"> </span><span class="mi">2</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">r15</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">r14</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">		</span><span class="nf">jne</span><span class="w">			</span><span class="no">.skipdev</span><span class="w"></span>
<span class="w">		</span><span class="c1">; save results</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">bootdiskblkio</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="c1">; FIXME: do some checks here to decide if it&#39;s your device or not</span>
<span class="w">		</span><span class="c1">; I load GPT from each device and look for a specific UUID for example</span>
<span class="w">		</span><span class="c1">; cmp ismydevice, 1</span>
<span class="w">		</span><span class="c1">; je .end</span>

<span class="nl">.skipdev:</span><span class="w">	</span><span class="nf">xor</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">bootdiskblkio</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">r15</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">r14</span><span class="w"></span>
<span class="w">		</span><span class="nf">add</span><span class="w">			</span><span class="no">r15</span><span class="p">,</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="w">		</span><span class="nf">sub</span><span class="w">			</span><span class="no">r14</span><span class="p">,</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="w">		</span><span class="nf">js</span><span class="w">			</span><span class="no">.error</span><span class="w"></span>
<span class="w">		</span><span class="nf">jnz</span><span class="w">			</span><span class="no">.nexthandle</span><span class="w"></span>

<span class="nl">.end:</span><span class="w">		</span><span class="nf">clc</span><span class="w"></span>
<span class="w">		</span><span class="nf">ret</span><span class="w"></span>

<span class="nl">.error:</span><span class="w">		</span><span class="nf">stc</span><span class="w"></span>
<span class="w">		</span><span class="nf">ret</span><span class="w"></span>

<span class="c1">;data</span>
<span class="nl">tmp:</span><span class="w">		</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">blkiouuid:</span><span class="w">	</span><span class="nf">db</span><span class="w">			</span><span class="no">EFI_BLOCK_IO_PROTOCOL_UUID</span><span class="w"></span>
<span class="nl">bootdiskblkio:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
</pre></div>
<h3><span class="mw-headline" id="Loading_a_sector_from_device">Loading a sector from device</span></h3>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">bootdiskblkio</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">stc</span><span class="w"></span>
<span class="w">		</span><span class="nf">or</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">jz</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rax</span><span class="err">+</span><span class="no">EFI_BLOCK_IO_PROTOCOL.Media</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">or</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">jz</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">edx</span><span class="p">,</span><span class="w"> </span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">rax</span><span class="err">+</span><span class="no">EFI_BLOCK_IO_MEDIA.MediaId</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">or</span><span class="w">			</span><span class="no">edx</span><span class="p">,</span><span class="w"> </span><span class="no">edx</span><span class="w"></span>
<span class="w">		</span><span class="nf">jz</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">xor</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_BLOCK_IO_PROTOCOL.ReadBlocks</span><span class="p">,</span><span class="w"> </span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">rdx</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">lba</span><span class="p">],</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">sizeinbytes</span><span class="p">],</span><span class="w"> </span><span class="no">diskbuff</span><span class="w"></span>
<span class="w">		</span><span class="nf">stc</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">		</span><span class="nf">jne</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">clc</span><span class="w"></span>
<span class="err">@@:</span><span class="w"></span>

<span class="c1">;data</span>
<span class="nl">lba:</span><span class="w">		</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">sizeinbytes:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">diskbuff:</span><span class="w">	</span><span class="nf">rb</span><span class="w">			</span><span class="no">DISK_BUFFSIZE</span><span class="w"></span>
</pre></div>
<h3><span class="mw-headline" id="Get_sorted_list_of_available_video_modes">Get sorted list of available video modes</span></h3>
<p>For a detailed description, see the <a href="GOP" title="GOP">GOP</a> article.
</p>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="w">		</span><span class="c1">; installation check on GOP. This must return buffer too small if GOP supported</span>
<span class="w">		</span><span class="nf">xor</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">BootServices</span><span class="p">,</span><span class="w"> </span><span class="no">LocateHandle</span><span class="p">,</span><span class="w"> </span><span class="mi">2</span><span class="p">,</span><span class="w"> </span><span class="no">gopuuid</span><span class="p">,</span><span class="w"> </span><span class="mi">0</span><span class="p">,</span><span class="w"> </span><span class="no">tmp</span><span class="p">,</span><span class="w"> </span><span class="no">gop_handle</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_BUFFER_TOO_SMALL</span><span class="w"></span>
<span class="w">		</span><span class="nf">jne</span><span class="w">			</span><span class="no">.error</span><span class="w"></span>
<span class="w">		</span><span class="c1">; query available video modes</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">],</span><span class="w"> </span><span class="no">MODE_BUFFSIZE</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">BootServices</span><span class="p">,</span><span class="w"> </span><span class="no">LocateHandle</span><span class="p">,</span><span class="w"> </span><span class="mi">2</span><span class="p">,</span><span class="w"> </span><span class="no">gopuuid</span><span class="p">,</span><span class="w"> </span><span class="mi">0</span><span class="p">,</span><span class="w"> </span><span class="no">tmp</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">tmpbuff</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">		</span><span class="nf">jne</span><span class="w">			</span><span class="no">.error</span><span class="w"></span>
<span class="w">		</span><span class="c1">; iterate on each handle, store sorted result to gopmodes</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rsi</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">tmpbuff</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">lea</span><span class="w">			</span><span class="no">rdi</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">gopmodes</span><span class="p">]</span><span class="w"></span>
<span class="nl">.getnextinfo:</span><span class="w">	</span><span class="nf">lodsq</span><span class="w"></span>
<span class="w">		</span><span class="nf">or</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">jz</span><span class="w">			</span><span class="no">.nomore</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rsi</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rdi</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">BootServices</span><span class="p">,</span><span class="w"> </span><span class="no">HandleProtocol</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">],</span><span class="w"> </span><span class="no">gopuuid</span><span class="p">,</span><span class="w"> </span><span class="no">gopinterface</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">rdi</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">rsi</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">		</span><span class="nf">jne</span><span class="w">			</span><span class="no">.error</span><span class="w"></span>
<span class="w">		</span><span class="c1">; iterate on each mode for a handle</span>
<span class="w">		</span><span class="c1">; get number of modes</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">gopinterface</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r10</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rcx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL.Mode</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r10</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">r10</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_MODE.MaxMode</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">xor</span><span class="w">			</span><span class="no">rdx</span><span class="p">,</span><span class="w"> </span><span class="no">rdx</span><span class="w"></span>
<span class="nl">.nextmode:</span><span class="w">	</span><span class="nf">mov</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">gopinterface</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">8</span><span class="p">],</span><span class="w"> </span><span class="no">rcx</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rsi</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rdi</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">],</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="w">		</span><span class="nf">lea</span><span class="w">			</span><span class="no">r8</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">tmp</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">lea</span><span class="w">			</span><span class="no">r9</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">gopinfo</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rcx</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rdx</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r10</span><span class="w"></span>
<span class="w">		</span><span class="nf">uefi_call_wrapper</span><span class="w">	</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL.QueryMode</span><span class="p">,</span><span class="w"> </span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">rdx</span><span class="p">,</span><span class="w"> </span><span class="no">r8</span><span class="p">,</span><span class="w"> </span><span class="no">r9</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">r10</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">rdx</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">rcx</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">rdi</span><span class="w"></span>
<span class="w">		</span><span class="nf">pop</span><span class="w">			</span><span class="no">rsi</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">EFI_SUCCESS</span><span class="w"></span>
<span class="w">		</span><span class="nf">jne</span><span class="w">			</span><span class="no">.error</span><span class="w"></span>
<span class="w">		</span><span class="c1">; save info to gopmodes</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r9</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">gopinfo</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">eax</span><span class="p">,</span><span class="w"> </span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">r9</span><span class="err">+</span><span class="no">EFI_GRAPHICS_OUTPUT_MODE_INFORMATION.HorizontalResolution</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">16</span><span class="p">],</span><span class="w"> </span><span class="no">ax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">eax</span><span class="p">,</span><span class="w"> </span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">r9</span><span class="err">+</span><span class="no">EFI_GRAPHICS_OUTPUT_MODE_INFORMATION.VerticalResolution</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">18</span><span class="p">],</span><span class="w"> </span><span class="no">ax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">eax</span><span class="p">,</span><span class="w"> </span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">r9</span><span class="err">+</span><span class="no">EFI_GRAPHICS_OUTPUT_MODE_INFORMATION.PixelsPerScanline</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">20</span><span class="p">],</span><span class="w"> </span><span class="no">ax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">ax</span><span class="p">,</span><span class="w"> </span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">r9</span><span class="err">+</span><span class="no">EFI_GRAPHICS_OUTPUT_MODE_INFORMATION.PixelFormat</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">22</span><span class="p">],</span><span class="w"> </span><span class="no">ax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">24</span><span class="p">],</span><span class="w"> </span><span class="no">edx</span><span class="w"></span>
<span class="w">		</span><span class="c1">;bubble up mode</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="no">rdi</span><span class="w"></span>
<span class="nl">.bubble:</span><span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">ax</span><span class="p">,</span><span class="w"> </span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">16</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">16-32</span><span class="p">],</span><span class="w"> </span><span class="no">ax</span><span class="w"></span>
<span class="w">		</span><span class="nf">ja</span><span class="w">			</span><span class="no">.ok2</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="no">.switch</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">ax</span><span class="p">,</span><span class="w"> </span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">18</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">word</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">18-32</span><span class="p">],</span><span class="w"> </span><span class="no">ax</span><span class="w"></span>
<span class="w">		</span><span class="nf">jae</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="nl">.switch:</span><span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">xchg</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi-32</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">8</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">xchg</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi-32</span><span class="err">+</span><span class="mi">8</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">8</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">16</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">xchg</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi-32</span><span class="err">+</span><span class="mi">16</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">16</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">24</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">xchg</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi-32</span><span class="err">+</span><span class="mi">24</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rdi</span><span class="err">+</span><span class="mi">24</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">sub</span><span class="w">			</span><span class="no">rdi</span><span class="p">,</span><span class="w"> </span><span class="mi">32</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">rdi</span><span class="p">,</span><span class="w"> </span><span class="no">gopmodes</span><span class="w"></span>
<span class="w">		</span><span class="nf">jae</span><span class="w">			</span><span class="no">.bubble</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rdi</span><span class="p">,</span><span class="w"> </span><span class="no">rbx</span><span class="w"></span>
<span class="w">		</span><span class="nf">add</span><span class="w">			</span><span class="no">rdi</span><span class="p">,</span><span class="w"> </span><span class="mi">32</span><span class="w"></span>
<span class="nl">.loop:</span><span class="w">		</span><span class="nf">inc</span><span class="w">			</span><span class="no">rdx</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">edx</span><span class="p">,</span><span class="w"> </span><span class="no">r10d</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="no">.nextmode</span><span class="w"></span>
<span class="w">		</span><span class="nf">jmp</span><span class="w">			</span><span class="no">.getnextinfo</span><span class="w"></span>
<span class="nl">.error:</span><span class="w">		</span><span class="nf">xor</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">gopinterface</span><span class="p">],</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">stc</span><span class="w"></span>
<span class="nl">.nomore:</span><span class="w"></span>

<span class="c1">;data</span>
<span class="nl">tmp:</span><span class="w">		</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">tmpbuff:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">gopuuid:</span><span class="w">	</span><span class="nf">db</span><span class="w">			</span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_UUID</span><span class="w"></span>
<span class="nl">gop_handle:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">gopinterface:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">gopinfo:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="c1">;output, sorted list of 32 byte entries</span>
<span class="c1">;  8 bytes handle</span>
<span class="c1">;  8 bytes interface</span>
<span class="c1">;  2 bytes horizontal resolution</span>
<span class="c1">;  2 bytes vertical resolution</span>
<span class="c1">;  2 bytes scanline</span>
<span class="c1">;  2 bytes pixelformat</span>
<span class="c1">;  8 bytes mode number</span>
<span class="nl">gopmodes:</span><span class="w">	</span><span class="nf">rb</span><span class="w">			</span><span class="no">MODE_BUFFSIZE</span><span class="w"></span>
</pre></div>
<p>To access framebuffer, you'll have to get it's address. This code returns it in rbx, and buffer's size in rcx:
</p>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">gopinterface</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rax</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL.Mode</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rax</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_MODE.FrameBufferBase</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">rax</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_MODE.FrameBufferSize</span><span class="p">]</span><span class="w"></span>
</pre></div>
<h2><span class="mw-headline" id="The_include_file">The include file</span></h2>
<p>And finally the library that makes the magic alive:
</p>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="c1">;*********************************************************************</span>
<span class="c1">;*                                                                   *</span>
<span class="c1">;*          UEFI library for fasm by bzt, Public Domain              *</span>
<span class="c1">;*                                                                   *</span>
<span class="c1">;*********************************************************************</span>

<span class="c1">; include x86asm.net&#39;s efi.inc</span>
<span class="c1">;include &#39;efi.inc&#39;</span>
<span class="nf">struc</span><span class="w"> </span><span class="no">int8</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w">  </span><span class="err">.</span><span class="w"> </span><span class="nf">db</span><span class="w"> </span><span class="err">?</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">int16</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w">  </span><span class="nf">align</span><span class="w"> </span><span class="mi">2</span><span class="w"></span>
<span class="w">  </span><span class="err">.</span><span class="w"> </span><span class="nf">dw</span><span class="w"> </span><span class="err">?</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">int32</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w">  </span><span class="nf">align</span><span class="w"> </span><span class="mi">4</span><span class="w"></span>
<span class="w">  </span><span class="err">.</span><span class="w"> </span><span class="nf">dd</span><span class="w"> </span><span class="err">?</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">int64</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w">  </span><span class="nf">align</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="w">  </span><span class="err">.</span><span class="w"> </span><span class="nf">dq</span><span class="w"> </span><span class="err">?</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">intn</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w">  </span><span class="nf">align</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="w">  </span><span class="err">.</span><span class="w"> </span><span class="nf">dq</span><span class="w"> </span><span class="err">?</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">dptr</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w">  </span><span class="nf">align</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="w">  </span><span class="err">.</span><span class="w"> </span><span class="nf">dq</span><span class="w"> </span><span class="err">?</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>

<span class="c1">;symbols</span>

<span class="nf">EFIERR</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="mi">0x8000000000000000</span><span class="w"></span>
<span class="nf">EFI_SUCCESS</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="mi">0</span><span class="w"></span>
<span class="nf">EFI_LOAD_ERROR</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="nf">EFI_INVALID_PARAMETER</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">2</span><span class="w"></span>
<span class="nf">EFI_UNSUPPORTED</span><span class="w"> 		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">3</span><span class="w"></span>
<span class="nf">EFI_BAD_BUFFER_SIZE</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">4</span><span class="w"></span>
<span class="nf">EFI_BUFFER_TOO_SMALL</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">5</span><span class="w"></span>
<span class="nf">EFI_NOT_READY</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">6</span><span class="w"></span>
<span class="nf">EFI_DEVICE_ERROR</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">7</span><span class="w"></span>
<span class="nf">EFI_WRITE_PROTECTED</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="nf">EFI_OUT_OF_RESOURCES</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">9</span><span class="w"></span>
<span class="nf">EFI_VOLUME_CORRUPTED</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">10</span><span class="w"></span>
<span class="nf">EFI_VOLUME_FULL</span><span class="w"> 		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">11</span><span class="w"></span>
<span class="nf">EFI_NO_MEDIA</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">12</span><span class="w"></span>
<span class="nf">EFI_MEDIA_CHANGED</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">13</span><span class="w"></span>
<span class="nf">EFI_NOT_FOUND</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">14</span><span class="w"></span>
<span class="nf">EFI_ACCESS_DENIED</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">15</span><span class="w"></span>
<span class="nf">EFI_NO_RESPONSE</span><span class="w"> 		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">16</span><span class="w"></span>
<span class="nf">EFI_NO_MAPPING</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">17</span><span class="w"></span>
<span class="nf">EFI_TIMEOUT</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">18</span><span class="w"></span>
<span class="nf">EFI_NOT_STARTED</span><span class="w"> 		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">19</span><span class="w"></span>
<span class="nf">EFI_ALREADY_STARTED</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">20</span><span class="w"></span>
<span class="nf">EFI_ABORTED</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">21</span><span class="w"></span>
<span class="nf">EFI_ICMP_ERROR</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">22</span><span class="w"></span>
<span class="nf">EFI_TFTP_ERROR</span><span class="w">			</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">23</span><span class="w"></span>
<span class="nf">EFI_PROTOCOL_ERROR</span><span class="w">		</span><span class="err">=</span><span class="w"> </span><span class="no">EFIERR</span><span class="w"> </span><span class="no">or</span><span class="w"> </span><span class="mi">24</span><span class="w"></span>

<span class="c1">;helper macro for definition of relative structure member offsets</span>

<span class="nf">macro</span><span class="w"> </span><span class="no">struct</span><span class="w"> </span><span class="no">name</span><span class="w"></span>
<span class="err">{</span><span class="w"></span>
<span class="w">  </span><span class="nf">virtual</span><span class="w"> </span><span class="no">at</span><span class="w"> </span><span class="mi">0</span><span class="w"></span>
<span class="w">    </span><span class="nf">name</span><span class="w"> </span><span class="no">name</span><span class="w"></span>
<span class="w">  </span><span class="nf">end</span><span class="w"> </span><span class="no">virtual</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>

<span class="c1">;structures</span>
<span class="nf">EFI_SYSTEM_TABLE_SIGNATURE</span><span class="w">	</span><span class="no">equ</span><span class="w">	</span><span class="mi">49</span><span class="no">h</span><span class="p">,</span><span class="mi">42</span><span class="no">h</span><span class="p">,</span><span class="mi">49</span><span class="no">h</span><span class="p">,</span><span class="mi">20</span><span class="no">h</span><span class="p">,</span><span class="mi">53</span><span class="no">h</span><span class="p">,</span><span class="mi">59</span><span class="no">h</span><span class="p">,</span><span class="mi">53</span><span class="no">h</span><span class="p">,</span><span class="mi">54</span><span class="no">h</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_TABLE_HEADER</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Signature</span><span class="w">    		</span><span class="no">int64</span><span class="w"></span>
<span class="w"> </span><span class="na">.Revision</span><span class="w">     		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.HeaderSize</span><span class="w">   		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.CRC32</span><span class="w">        		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.Reserved</span><span class="w">     		</span><span class="no">int32</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_TABLE_HEADER</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_SYSTEM_TABLE</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Hdr</span><span class="w">		        </span><span class="no">EFI_TABLE_HEADER</span><span class="w"></span>
<span class="w"> </span><span class="na">.FirmwareVendor</span><span class="w">        </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.FirmwareRevision</span><span class="w">      </span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.ConsoleInHandle</span><span class="w">       </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ConIn</span><span class="w"> 	        </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ConsoleOutHandle</span><span class="w">      </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ConOut</span><span class="w">	        </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.StandardErrorHandle</span><span class="w">   </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.StdErr</span><span class="w">	        </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.RuntimeServices</span><span class="w">       </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.BootServices</span><span class="w">	        </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.NumberOfTableEntries</span><span class="w">  </span><span class="no">intn</span><span class="w"></span>
<span class="w"> </span><span class="na">.ConfigurationTable</span><span class="w">    </span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_SYSTEM_TABLE</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">SIMPLE_TEXT_OUTPUT_INTERFACE</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Reset</span><span class="w"> 	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.OutputString</span><span class="w">	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.TestString</span><span class="w">	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.QueryMode</span><span class="w">	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetMode</span><span class="w">	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetAttribute</span><span class="w">	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ClearScreen</span><span class="w">	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetCursorPosition</span><span class="w"> 	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.EnableCursor</span><span class="w">	    	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Mode</span><span class="w">		    	</span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">SIMPLE_TEXT_OUTPUT_INTERFACE</span><span class="w"></span>

<span class="c1">;---include ends</span>

<span class="nf">struc</span><span class="w"> </span><span class="no">SIMPLE_INPUT_INTERFACE</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Reset</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ReadKeyStroke</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.WaitForKey</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">SIMPLE_INPUT_INTERFACE</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_BOOT_SERVICES_TABLE</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Hdr</span><span class="w">		       	</span><span class="no">EFI_TABLE_HEADER</span><span class="w"></span>
<span class="w"> </span><span class="na">.RaisePriority</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.RestorePriority</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.AllocatePages</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.FreePages</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.GetMemoryMap</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.AllocatePool</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.FreePool</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.CreateEvent</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetTimer</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.WaitForEvent</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SignalEvent</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.CloseEvent</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.CheckEvent</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.InstallProtocolInterface</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ReInstallProtocolInterface</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.UnInstallProtocolInterface</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.HandleProtocol</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Void</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.RegisterProtocolNotify</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.LocateHandle</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.LocateDevicePath</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.InstallConfigurationTable</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ImageLoad</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ImageStart</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Exit</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ImageUnLoad</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ExitBootServices</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.GetNextMonotonicCount</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Stall</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetWatchdogTimer</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ConnectController</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.DisConnectController</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.OpenProtocol</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.CloseProtocol</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.OpenProtocolInformation</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ProtocolsPerHandle</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.LocateHandleBuffer</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.LocateProtocol</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.InstallMultipleProtocolInterfaces</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.UnInstallMultipleProtocolInterfaces</span><span class="w"> </span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.CalculateCrc32</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.CopyMem</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetMem</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_BOOT_SERVICES_TABLE</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_RUNTIME_SERVICES_TABLE</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Hdr</span><span class="w">		       	</span><span class="no">EFI_TABLE_HEADER</span><span class="w"></span>
<span class="w"> </span><span class="na">.GetTime</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetTime</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.GetWakeUpTime</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetWakeUpTime</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetVirtualAddressMap</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ConvertPointer</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.GetVariable</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.GetNextVariableName</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetVariable</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.GetNextHighMonoCount</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ResetSystem</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_RUNTIME_SERVICES_TABLE</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_TIME</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Year</span><span class="w">			</span><span class="no">int16</span><span class="w"></span>
<span class="w"> </span><span class="na">.Month</span><span class="w">			</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.Day</span><span class="w">			</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.Hour</span><span class="w">			</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.Minute</span><span class="w">		</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.Second</span><span class="w">		</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.Pad1</span><span class="w">			</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.Nanosecond</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.TimeZone</span><span class="w">		</span><span class="no">int16</span><span class="w"></span>
<span class="w"> </span><span class="na">.Daylight</span><span class="w">		</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.Pad2</span><span class="w">			</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.sizeof</span><span class="w">		</span><span class="no">rb</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_TIME</span><span class="w"></span>

<span class="nf">EFI_LOADED_IMAGE_PROTOCOL_UUID</span><span class="w"> </span><span class="no">equ</span><span class="w"> </span><span class="mi">0</span><span class="no">A1h</span><span class="p">,</span><span class="mi">31</span><span class="no">h</span><span class="p">,</span><span class="mi">1</span><span class="no">bh</span><span class="p">,</span><span class="mi">5</span><span class="no">bh</span><span class="p">,</span><span class="mi">62</span><span class="no">h</span><span class="p">,</span><span class="mi">95</span><span class="no">h</span><span class="p">,</span><span class="mi">0</span><span class="no">d2h</span><span class="p">,</span><span class="mi">11</span><span class="no">h</span><span class="p">,</span><span class="mi">8</span><span class="no">Eh</span><span class="p">,</span><span class="mi">3</span><span class="no">Fh</span><span class="p">,</span><span class="mi">0</span><span class="no">h</span><span class="p">,</span><span class="mi">0</span><span class="no">A0h</span><span class="p">,</span><span class="mi">0</span><span class="no">C9h</span><span class="p">,</span><span class="mi">69</span><span class="no">h</span><span class="p">,</span><span class="mi">72</span><span class="no">h</span><span class="p">,</span><span class="mi">3</span><span class="no">Bh</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_LOADED_IMAGE_PROTOCOL</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Revision</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.ParentHandle</span><span class="w">		</span><span class="no">int64</span><span class="w"></span>
<span class="w"> </span><span class="na">.SystemTable</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.DeviceHandle</span><span class="w">		</span><span class="no">int64</span><span class="w"></span>
<span class="w"> </span><span class="na">.FilePath</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Reserved</span><span class="w">		</span><span class="no">int64</span><span class="w"></span>
<span class="w"> </span><span class="na">.LoadOptionsSize</span><span class="w">	</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.ImageBase</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ImageSize</span><span class="w">		</span><span class="no">int64</span><span class="w"></span>
<span class="w"> </span><span class="na">.ImageCodeType</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.ImageDataType</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.UnLoad</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_LOADED_IMAGE_PROTOCOL</span><span class="w"></span>

<span class="nf">EFI_BLOCK_IO_PROTOCOL_UUID</span><span class="w"> </span><span class="no">equ</span><span class="w"> </span><span class="mi">21</span><span class="no">h</span><span class="p">,</span><span class="mi">5</span><span class="no">bh</span><span class="p">,</span><span class="mi">4</span><span class="no">eh</span><span class="p">,</span><span class="mi">96</span><span class="no">h</span><span class="p">,</span><span class="mi">59</span><span class="no">h</span><span class="p">,</span><span class="mi">64</span><span class="no">h</span><span class="p">,</span><span class="mi">0</span><span class="no">d2h</span><span class="p">,</span><span class="mi">11</span><span class="no">h</span><span class="p">,</span><span class="mi">8</span><span class="no">eh</span><span class="p">,</span><span class="mi">39</span><span class="no">h</span><span class="p">,</span><span class="mi">00</span><span class="no">h</span><span class="p">,</span><span class="mi">0</span><span class="no">a0h</span><span class="p">,</span><span class="mi">0</span><span class="no">c9h</span><span class="p">,</span><span class="mi">69</span><span class="no">h</span><span class="p">,</span><span class="mi">72</span><span class="no">h</span><span class="p">,</span><span class="mi">3</span><span class="no">bh</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_BLOCK_IO_PROTOCOL</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Revision</span><span class="w">		</span><span class="no">int64</span><span class="w"></span>
<span class="w"> </span><span class="na">.Media</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Reset</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.ReadBlocks</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.WriteBlocks</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.FlushBlocks</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_BLOCK_IO_PROTOCOL</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_BLOCK_IO_MEDIA</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.MediaId</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.RemovableMedia</span><span class="w">	</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.MediaPresent</span><span class="w">		</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.LogicalPartition</span><span class="w">	</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.ReadOnly</span><span class="w">		</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.WriteCaching</span><span class="w">		</span><span class="no">int8</span><span class="w"></span>
<span class="w"> </span><span class="na">.BlockSize</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.IoAlign</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.LastBlock</span><span class="w">		</span><span class="no">int64</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_BLOCK_IO_MEDIA</span><span class="w"></span>

<span class="nf">EFI_GRAPHICS_OUTPUT_PROTOCOL_UUID</span><span class="w"> </span><span class="no">equ</span><span class="w"> </span><span class="mi">0</span><span class="no">deh</span><span class="p">,</span><span class="w"> </span><span class="mi">0</span><span class="no">a9h</span><span class="p">,</span><span class="w"> </span><span class="mi">42</span><span class="no">h</span><span class="p">,</span><span class="mi">90</span><span class="no">h</span><span class="p">,</span><span class="mi">0</span><span class="no">dch</span><span class="p">,</span><span class="mi">023</span><span class="no">h</span><span class="p">,</span><span class="mi">38</span><span class="no">h</span><span class="p">,</span><span class="mi">04</span><span class="no">ah</span><span class="p">,</span><span class="mi">96</span><span class="no">h</span><span class="p">,</span><span class="mi">0</span><span class="no">fbh</span><span class="p">,</span><span class="mi">7</span><span class="no">ah</span><span class="p">,</span><span class="mi">0</span><span class="no">deh</span><span class="p">,</span><span class="mi">0</span><span class="no">d0h</span><span class="p">,</span><span class="mi">80</span><span class="no">h</span><span class="p">,</span><span class="mi">51</span><span class="no">h</span><span class="p">,</span><span class="mi">6</span><span class="no">ah</span><span class="w"></span>
<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.QueryMode</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SetMode</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Blt</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.Mode</span><span class="w">			</span><span class="no">dptr</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_MODE</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.MaxMode</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.CurrentMode</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.ModeInfo</span><span class="w">		</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.SizeOfModeInfo</span><span class="w">	</span><span class="no">intn</span><span class="w"></span>
<span class="w"> </span><span class="na">.FrameBufferBase</span><span class="w">	</span><span class="no">dptr</span><span class="w"></span>
<span class="w"> </span><span class="na">.FrameBufferSize</span><span class="w">	</span><span class="no">intn</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_MODE</span><span class="w"></span>

<span class="nf">struc</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_MODE_INFORMATION</span><span class="w"> </span><span class="err">{</span><span class="w"></span>
<span class="w"> </span><span class="na">.Version</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.HorizontalResolution</span><span class="w">	</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.VerticalResolution</span><span class="w">	</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.PixelFormat</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.RedMask</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.GreenMask</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.BlueMask</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.Reserved</span><span class="w">		</span><span class="no">int32</span><span class="w"></span>
<span class="w"> </span><span class="na">.PixelsPerScanline</span><span class="w">	</span><span class="no">int32</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>
<span class="nf">struct</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_MODE_INFORMATION</span><span class="w"></span>
<span class="c1">;---macros to make life easier---</span>
<span class="c1">;call it early, after entry point is the best</span>
<span class="nf">macro</span><span class="w"> </span><span class="no">InitializeLib</span><span class="w"></span>
<span class="err">{</span><span class="w"></span>
<span class="w">		</span><span class="nf">clc</span><span class="w"></span>
<span class="w">		</span><span class="nf">or</span><span class="w">			</span><span class="no">rdx</span><span class="p">,</span><span class="w"> </span><span class="no">rdx</span><span class="w"></span>
<span class="w">		</span><span class="nf">jz</span><span class="w">			</span><span class="no">.badout</span><span class="w"></span>
<span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">dword</span><span class="w"> </span><span class="p">[</span><span class="no">rdx</span><span class="p">],</span><span class="w"> </span><span class="mi">20494249</span><span class="no">h</span><span class="w"></span>
<span class="w">		</span><span class="nf">je</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="nl">.badout:</span><span class="w">	  </span><span class="nf">xor</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">rcx</span><span class="w"></span>
<span class="w">		</span><span class="nf">xor</span><span class="w">			</span><span class="no">rdx</span><span class="p">,</span><span class="w"> </span><span class="no">rdx</span><span class="w"></span>
<span class="w">		</span><span class="nf">stc</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="p">[</span><span class="no">efi_handler</span><span class="p">],</span><span class="w"> </span><span class="no">rcx</span><span class="w">		</span><span class="c1">; ImageHandle</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="p">[</span><span class="no">efi_ptr</span><span class="p">],</span><span class="w"> </span><span class="no">rdx</span><span class="w">    		</span><span class="c1">; pointer to SystemTable</span>
<span class="err">}</span><span class="w"></span>

<span class="c1">;invoke an UEFI function</span>
<span class="nf">macro</span><span class="w"> </span><span class="no">uefi_call_wrapper</span><span class="w">			</span><span class="no">interface</span><span class="p">,</span><span class="no">function</span><span class="p">,</span><span class="no">arg1</span><span class="p">,</span><span class="no">arg2</span><span class="p">,</span><span class="no">arg3</span><span class="p">,</span><span class="no">arg4</span><span class="p">,</span><span class="no">arg5</span><span class="p">,</span><span class="no">arg6</span><span class="p">,</span><span class="no">arg7</span><span class="p">,</span><span class="no">arg8</span><span class="p">,</span><span class="no">arg9</span><span class="p">,</span><span class="no">arg10</span><span class="p">,</span><span class="no">arg11</span><span class="w"></span>
<span class="err">{</span><span class="w"></span>
<span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="mi">0</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg11</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg11</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">rdi</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rdi</span><span class="p">,</span><span class="w"> </span><span class="no">arg11</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg10</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg10</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">rsi</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rsi</span><span class="p">,</span><span class="w"> </span><span class="no">arg10</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg9</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg9</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">r14</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r14</span><span class="p">,</span><span class="w"> </span><span class="no">arg9</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg8</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg8</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">r13</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r13</span><span class="p">,</span><span class="w"> </span><span class="no">arg8</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg7</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg7</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">r12</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r12</span><span class="p">,</span><span class="w"> </span><span class="no">arg7</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg6</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg6</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">r11</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r11</span><span class="p">,</span><span class="w"> </span><span class="no">arg6</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg5</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg5</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">r10</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r10</span><span class="p">,</span><span class="w"> </span><span class="no">arg5</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg4</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg4</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">r9</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r9</span><span class="p">,</span><span class="w"> </span><span class="no">arg4</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg3</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg3</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">r8</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">r8</span><span class="p">,</span><span class="w"> </span><span class="no">arg3</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg2</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg2</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">rdx</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rdx</span><span class="p">,</span><span class="w"> </span><span class="no">arg2</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg1</span><span class="w"> </span><span class="no">eq</span><span class="w"></span>
<span class="w"> </span><span class="nf">numarg</span><span class="w"> </span><span class="err">=</span><span class="w"> </span><span class="no">numarg</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="mi">1</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg1</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">rcx</span><span class="w"></span>
<span class="w">  </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">arg1</span><span class="w"> </span><span class="no">in</span><span class="w"> </span><span class="err">&lt;</span><span class="no">ConsoleInHandle</span><span class="p">,</span><span class="no">ConIn</span><span class="p">,</span><span class="no">ConsoleOutHandle</span><span class="p">,</span><span class="no">ConOut</span><span class="p">,</span><span class="no">StandardErrorHandle</span><span class="p">,</span><span class="no">StdErr</span><span class="p">,</span><span class="no">RuntimeServices</span><span class="p">,</span><span class="no">BootServices</span><span class="err">&gt;</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">arg1</span><span class="w"></span>
<span class="w">  </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="w">		</span><span class="nf">xor</span><span class="w">			</span><span class="no">rax</span><span class="p">,</span><span class="w"> </span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="no">numarg</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="no">interface</span><span class="w"> </span><span class="no">in</span><span class="w"> </span><span class="err">&lt;</span><span class="no">ConsoleInHandle</span><span class="p">,</span><span class="no">ConIn</span><span class="p">,</span><span class="no">ConsoleOutHandle</span><span class="p">,</span><span class="no">ConOut</span><span class="p">,</span><span class="no">StandardErrorHandle</span><span class="p">,</span><span class="no">StdErr</span><span class="p">,</span><span class="no">RuntimeServices</span><span class="p">,</span><span class="no">BootServices</span><span class="err">&gt;</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">efi_ptr</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_SYSTEM_TABLE.</span><span class="c1">#interface]</span>
<span class="nf">else</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="err">~</span><span class="w"> </span><span class="no">interface</span><span class="w"> </span><span class="no">eq</span><span class="w"> </span><span class="no">rbx</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="no">interface</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="no">arg1</span><span class="w"> </span><span class="no">in</span><span class="w"> </span><span class="err">&lt;</span><span class="no">ConsoleInHandle</span><span class="p">,</span><span class="no">ConIn</span><span class="p">,</span><span class="no">ConsoleOutHandle</span><span class="p">,</span><span class="no">ConOut</span><span class="p">,</span><span class="no">StandardErrorHandle</span><span class="p">,</span><span class="no">StdErr</span><span class="p">,</span><span class="no">RuntimeServices</span><span class="p">,</span><span class="no">BootServices</span><span class="err">&gt;</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rcx</span><span class="p">,</span><span class="w"> </span><span class="no">rbx</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">if</span><span class="w"> </span><span class="no">defined</span><span class="w"> </span><span class="no">SIMPLE_INPUT_INTERFACE.</span><span class="c1">#function</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">SIMPLE_INPUT_INTERFACE.</span><span class="c1">#function]</span>
<span class="nf">else</span><span class="w"></span>
<span class="w"> </span><span class="nf">if</span><span class="w"> </span><span class="no">defined</span><span class="w"> </span><span class="no">SIMPLE_TEXT_OUTPUT_INTERFACE.</span><span class="c1">#function</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">SIMPLE_TEXT_OUTPUT_INTERFACE.</span><span class="c1">#function]</span>
<span class="w"> </span><span class="nf">else</span><span class="w"></span>
<span class="w">  </span><span class="nf">if</span><span class="w"> </span><span class="no">defined</span><span class="w"> </span><span class="no">EFI_BOOT_SERVICES_TABLE.</span><span class="c1">#function</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_BOOT_SERVICES_TABLE.</span><span class="c1">#function]</span>
<span class="w">  </span><span class="nf">else</span><span class="w"></span>
<span class="w">   </span><span class="nf">if</span><span class="w"> </span><span class="no">defined</span><span class="w"> </span><span class="no">EFI_RUNTIME_SERVICES_TABLE.</span><span class="c1">#function</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_RUNTIME_SERVICES_TABLE.</span><span class="c1">#function]</span>
<span class="w">   </span><span class="nf">else</span><span class="w"></span>
<span class="w">    </span><span class="nf">if</span><span class="w"> </span><span class="no">defined</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL.</span><span class="c1">#function</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL.</span><span class="c1">#function]</span>
<span class="w">    </span><span class="nf">else</span><span class="w"></span>
<span class="w">     </span><span class="nf">if</span><span class="w"> </span><span class="no">defined</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_MODE.</span><span class="c1">#function</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">EFI_GRAPHICS_OUTPUT_PROTOCOL_MODE.</span><span class="c1">#function]</span>
<span class="w">     </span><span class="nf">else</span><span class="w"></span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rbx</span><span class="p">,</span><span class="w"> </span><span class="p">[</span><span class="no">rbx</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">function</span><span class="p">]</span><span class="w"></span>
<span class="w">     </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="w">    </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="w">   </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="w">  </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="w"> </span><span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="nf">end</span><span class="w"> </span><span class="no">if</span><span class="w"></span>
<span class="w">		</span><span class="nf">call</span><span class="w">			</span><span class="no">uefifunc</span><span class="w"></span>
<span class="err">}</span><span class="w"></span>

<span class="c1">;*********************************************************************</span>
<span class="c1">;*                       Library functions                           *</span>
<span class="c1">;*********************************************************************</span>

<span class="nf">section</span><span class="w"> </span><span class="err">&#39;</span><span class="no">.text</span><span class="err">&#39;</span><span class="w"> </span><span class="no">code</span><span class="w"> </span><span class="no">executable</span><span class="w"> </span><span class="no">readable</span><span class="w"></span>

<span class="nl">uefifunc:</span><span class="w">	</span><span class="c1">;save stack pointer</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">uefi_rsptmp</span><span class="p">],</span><span class="w"> </span><span class="no">rsp</span><span class="w"></span>
<span class="w">		</span><span class="c1">;set up new aligned stack</span>
<span class="w">		</span><span class="nf">and</span><span class="w">			</span><span class="no">esp</span><span class="p">,</span><span class="w"> </span><span class="mi">0</span><span class="no">FFFFFFF0h</span><span class="w"></span>
<span class="w">		</span><span class="c1">;alignment check on arguments</span>
<span class="w">		</span><span class="nf">bt</span><span class="w">			</span><span class="no">eax</span><span class="p">,</span><span class="w"> </span><span class="mi">0</span><span class="w"></span>
<span class="w">		</span><span class="nf">jnc</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rax</span><span class="w"></span>
<span class="w">		</span><span class="c1">;arguments</span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="mi">11</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rdi</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="mi">10</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">rsi</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="mi">9</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r14</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="mi">8</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r13</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="mi">7</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r12</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="mi">6</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r11</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="nf">cmp</span><span class="w">			</span><span class="no">al</span><span class="p">,</span><span class="w"> </span><span class="mi">5</span><span class="w"></span>
<span class="w">		</span><span class="nf">jb</span><span class="w">			</span><span class="err">@</span><span class="no">f</span><span class="w"></span>
<span class="w">		</span><span class="nf">push</span><span class="w">			</span><span class="no">r10</span><span class="w"></span>
<span class="err">@@:</span><span class="w">		</span><span class="c1">;space for</span>
<span class="w">		</span><span class="c1">;r9</span>
<span class="w">		</span><span class="c1">;r8</span>
<span class="w">		</span><span class="c1">;rdx</span>
<span class="w">		</span><span class="c1">;rcx</span>
<span class="w">		</span><span class="nf">sub</span><span class="w">			</span><span class="no">rsp</span><span class="p">,</span><span class="w"> </span><span class="mi">4</span><span class="p">*</span><span class="mi">8</span><span class="w"></span>
<span class="w">		</span><span class="c1">;call function</span>
<span class="w">		</span><span class="nf">call</span><span class="w">			</span><span class="no">rbx</span><span class="w"></span>
<span class="w">		</span><span class="c1">;restore old stack</span>
<span class="w">		</span><span class="nf">mov</span><span class="w">			</span><span class="no">rsp</span><span class="p">,</span><span class="w"> </span><span class="no">qword</span><span class="w"> </span><span class="p">[</span><span class="no">uefi_rsptmp</span><span class="p">]</span><span class="w"></span>
<span class="w">		</span><span class="nf">ret</span><span class="w"></span>

<span class="nf">section</span><span class="w"> </span><span class="err">&#39;</span><span class="no">.data</span><span class="err">&#39;</span><span class="w"> </span><span class="no">data</span><span class="w"> </span><span class="no">readable</span><span class="w"> </span><span class="no">writeable</span><span class="w"></span>
<span class="nl">efi_handler:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">efi_ptr:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
<span class="nl">uefi_rsptmp:</span><span class="w">	</span><span class="nf">dq</span><span class="w">			</span><span class="mi">0</span><span class="w"></span>
</pre></div>
<!-- 
NewPP limit report
Cached time: 20250211123704
Cache expiry: 86400
Reduced expiry: false
Complications: [show‐toc]
CPU time usage: 0.105 seconds
Real time usage: 1.056 seconds
Preprocessor visited node count: 80/1000000
Post‐expand include size: 507/2097152 bytes
Template argument size: 4/2097152 bytes
Highest expansion depth: 5/100
Expensive parser function count: 0/100
Unstrip recursion depth: 0/20
Unstrip post‐expand size: 121870/5000000 bytes
-->
<!--
Transclusion expansion time report (%,ms,calls,template)
100.00%    1.398      1 -total
100.00%    1.398      1 Template:TutorialTone
 51.37%    0.718      1 Template:EditThis
-->

<!-- Saved in parser cache with key wikidb:pcache:idhash:3317-0!canonical and timestamp 20250211123703 and revision id 25442.
 -->
</div>
<div class="printfooter" data-nosnippet="">Retrieved from "<a dir="ltr" href="https://wiki.osdev.org/index.php?title=Uefi.inc&amp;oldid=25442">https://wiki.osdev.org/index.php?title=Uefi.inc&amp;oldid=25442</a>"</div></div>
		<div id="catlinks" class="catlinks" data-mw="interface"><div id="mw-normal-catlinks" class="mw-normal-catlinks"><a href="./Special:Categories" title="Special:Categories">Categories</a>: <ul><li><a href="https://wiki.osdev.org/index.php?title=Category:Pages_using_deprecated_source_tags&amp;action=edit&amp;redlink=1" class="new" title="Category:Pages using deprecated source tags (page does not exist)">Pages using deprecated source tags</a></li><li><a href="./Category:Tone" title="Category:Tone">Tone</a></li><li><a href="./Category:UEFI" title="Category:UEFI">UEFI</a></li><li><a href="./Category:X86" title="Category:X86">X86</a></li></ul></div></div>
	</div>
</div>

<div id="mw-navigation">
	<h2>Navigation menu</h2>
	<div id="mw-head">
		

<nav id="p-personal" class="vector-menu mw-portlet mw-portlet-personal vector-user-menu-legacy" aria-labelledby="p-personal-label" role="navigation"  >
	<h3
		id="p-personal-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">Personal tools</span>
	</h3>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"><li id="pt-login" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Special:UserLogin&amp;returnto=Uefi.inc" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o"><span>Log in</span></a></li><li id="pt-darkmode" class="mw-list-item"><a href="Uefi.inc#" class="ext-darkmode-link"><span>Dark mode</span></a></li></ul>
		
	</div>
</nav>

		<div id="left-navigation">
			

<nav id="p-namespaces" class="vector-menu mw-portlet mw-portlet-namespaces vector-menu-tabs vector-menu-tabs-legacy" aria-labelledby="p-namespaces-label" role="navigation"  >
	<h3
		id="p-namespaces-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">Namespaces</span>
	</h3>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"><li id="ca-nstab-main" class="selected mw-list-item"><a href="Uefi.inc" title="View the content page [c]" accesskey="c"><span>Page</span></a></li><li id="ca-talk" class="new mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Talk:Uefi.inc&amp;action=edit&amp;redlink=1" rel="discussion" title="Discussion about the content page (page does not exist) [t]" accesskey="t"><span>Discussion</span></a></li></ul>
		
	</div>
</nav>

			

<nav id="p-variants" class="vector-menu mw-portlet mw-portlet-variants emptyPortlet vector-menu-dropdown" aria-labelledby="p-variants-label" role="navigation"  >
	<input type="checkbox"
		id="p-variants-checkbox"
		role="button"
		aria-haspopup="true"
		data-event-name="ui.dropdown-p-variants"
		class="vector-menu-checkbox"
		aria-labelledby="p-variants-label"
	/>
	<label
		id="p-variants-label"
		 aria-label="Change language variant"
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">English</span>
	</label>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"></ul>
		
	</div>
</nav>

		</div>
		<div id="right-navigation">
			

<nav id="p-views" class="vector-menu mw-portlet mw-portlet-views vector-menu-tabs vector-menu-tabs-legacy" aria-labelledby="p-views-label" role="navigation"  >
	<h3
		id="p-views-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">Views</span>
	</h3>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"><li id="ca-view" class="selected mw-list-item"><a href="Uefi.inc"><span>Read</span></a></li><li id="ca-viewsource" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Uefi.inc&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e"><span>View source</span></a></li><li id="ca-history" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Uefi.inc&amp;action=history" title="Past revisions of this page [h]" accesskey="h"><span>View history</span></a></li></ul>
		
	</div>
</nav>

			

<nav id="p-cactions" class="vector-menu mw-portlet mw-portlet-cactions emptyPortlet vector-menu-dropdown" aria-labelledby="p-cactions-label" role="navigation"  title="More options" >
	<input type="checkbox"
		id="p-cactions-checkbox"
		role="button"
		aria-haspopup="true"
		data-event-name="ui.dropdown-p-cactions"
		class="vector-menu-checkbox"
		aria-labelledby="p-cactions-label"
	/>
	<label
		id="p-cactions-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">More</span>
	</label>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"></ul>
		
	</div>
</nav>

			
<div id="p-search" role="search" class="vector-search-box-vue  vector-search-box-show-thumbnail vector-search-box-auto-expand-width vector-search-box">
	<div>
			<h3 >
				<label for="searchInput">Search</label>
			</h3>
		<form action="https://wiki.osdev.org/index.php" id="searchform"
			class="vector-search-box-form">
			<div id="simpleSearch"
				class="vector-search-box-inner"
				 data-search-loc="header-navigation">
				<input class="vector-search-box-input"
					 type="search" name="search" placeholder="Search OSDev Wiki" aria-label="Search OSDev Wiki" autocapitalize="sentences" title="Search OSDev Wiki [f]" accesskey="f" id="searchInput"
				>
				<input type="hidden" name="title" value="Special:Search">
				<input id="mw-searchButton"
					 class="searchButton mw-fallbackSearchButton" type="submit" name="fulltext" title="Search the pages for this text" value="Search">
				<input id="searchButton"
					 class="searchButton" type="submit" name="go" title="Go to a page with this exact name if it exists" value="Go">
			</div>
		</form>
	</div>
</div>

		</div>
	</div>
	

<div id="mw-panel">
	<div id="p-logo" role="banner">
		<a class="mw-wiki-logo" href="index.html"
			title="Visit the main page"></a>
	</div>
	

<nav id="p-navigation" class="vector-menu mw-portlet mw-portlet-navigation vector-menu-portal portal" aria-labelledby="p-navigation-label" role="navigation"  >
	<h3
		id="p-navigation-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">Navigation</span>
	</h3>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"><li id="n-mainpage" class="mw-list-item"><a href="index.html" title="Visit the main page [z]" accesskey="z"><span>Main Page</span></a></li><li id="n-portal" class="mw-list-item"><a href="http://forum.osdev.org/" rel="nofollow" title="About the project, what you can do, where to find things"><span>Forums</span></a></li><li id="n-FAQ" class="mw-list-item"><a href="./Category:FAQ"><span>FAQ</span></a></li><li id="n-OS-Projects" class="mw-list-item"><a href="Projects"><span>OS Projects</span></a></li><li id="n-randompage" class="mw-list-item"><a href="https://wiki.osdev.org/Special:Random" title="Load a random page [x]" accesskey="x"><span>Random page</span></a></li></ul>
		
	</div>
</nav>

	

<nav id="p-about" class="vector-menu mw-portlet mw-portlet-about vector-menu-portal portal" aria-labelledby="p-about-label" role="navigation"  >
	<h3
		id="p-about-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">About</span>
	</h3>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"><li id="n-This-site" class="mw-list-item"><a href="./OSDevWiki:About"><span>This site</span></a></li><li id="n-Joining" class="mw-list-item"><a href="./OSDevWiki:Joining"><span>Joining</span></a></li><li id="n-Editing-help" class="mw-list-item"><a href="./OSDevWiki:Editing"><span>Editing help</span></a></li><li id="n-recentchanges" class="mw-list-item"><a href="./Special:RecentChanges" title="A list of recent changes in the wiki [r]" accesskey="r"><span>Recent changes</span></a></li></ul>
		
	</div>
</nav>


<nav id="p-tb" class="vector-menu mw-portlet mw-portlet-tb vector-menu-portal portal" aria-labelledby="p-tb-label" role="navigation"  >
	<h3
		id="p-tb-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">Tools</span>
	</h3>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"><li id="t-whatlinkshere" class="mw-list-item"><a href="./Special:WhatLinksHere/Uefi.inc" title="A list of all wiki pages that link here [j]" accesskey="j"><span>What links here</span></a></li><li id="t-recentchangeslinked" class="mw-list-item"><a href="https://wiki.osdev.org/Special:RecentChangesLinked/Uefi.inc" rel="nofollow" title="Recent changes in pages linked from this page [k]" accesskey="k"><span>Related changes</span></a></li><li id="t-specialpages" class="mw-list-item"><a href="./Special:SpecialPages" title="A list of all special pages [q]" accesskey="q"><span>Special pages</span></a></li><li id="t-print" class="mw-list-item"><a href="javascript:print();" rel="alternate" title="Printable version of this page [p]" accesskey="p"><span>Printable version</span></a></li><li id="t-permalink" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Uefi.inc&amp;oldid=25442" title="Permanent link to this revision of this page"><span>Permanent link</span></a></li><li id="t-info" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Uefi.inc&amp;action=info" title="More information about this page"><span>Page information</span></a></li></ul>
		
	</div>
</nav>

	
</div>

</div>

<footer id="footer" class="mw-footer" role="contentinfo" >
	<ul id="footer-info">
	<li id="footer-info-lastmod"> This page was last edited on 15 December 2020, at 16:46.</li>
	<li id="footer-info-0">This page has been accessed 7,264 times.</li>
</ul>

	<ul id="footer-places">
	<li id="footer-places-privacy"><a href="./OSDev_Wiki:Privacy_policy">Privacy policy</a></li>
	<li id="footer-places-about"><a href="./OSDev_Wiki:About">About OSDev Wiki</a></li>
	<li id="footer-places-disclaimer"><a href="./OSDev_Wiki:General_disclaimer">Disclaimers</a></li>
	<li id="footer-places-mobileview"><a href="https://wiki.osdev.org/index.php?title=Uefi.inc&amp;mobileaction=toggle_view_mobile" class="noprint stopMobileRedirectToggle">Mobile view</a></li>
</ul>

	<ul id="footer-icons" class="noprint">
	<li id="footer-poweredbyico"><a href="https://www.mediawiki.org/"><img src="resources/assets/poweredby_mediawiki_88x31.png" alt="Powered by MediaWiki" srcset="resources/assets/poweredby_mediawiki_132x47.png 1.5x, resources/assets/poweredby_mediawiki_176x62.png 2x" width="88" height="31" loading="lazy"/></a></li>
</ul>

</footer>

<script>(RLQ=window.RLQ||[]).push(function(){mw.config.set({"wgPageParseReport":{"limitreport":{"cputime":"0.105","walltime":"1.056","ppvisitednodes":{"value":80,"limit":1000000},"postexpandincludesize":{"value":507,"limit":2097152},"templateargumentsize":{"value":4,"limit":2097152},"expansiondepth":{"value":5,"limit":100},"expensivefunctioncount":{"value":0,"limit":100},"unstrip-depth":{"value":0,"limit":20},"unstrip-size":{"value":121870,"limit":5000000},"timingprofile":["100.00%    1.398      1 -total","100.00%    1.398      1 Template:TutorialTone"," 51.37%    0.718      1 Template:EditThis"]},"cachereport":{"timestamp":"20250211123704","ttl":86400,"transientcontent":false}}});mw.config.set({"wgBackendResponseTime":1154});});</script>
</body>
</html>