<!DOCTYPE html>
<html class="client-nojs" lang="en" dir="ltr">
<head>
<meta charset="UTF-8"/>
<title>User:Solar/Makefile - OSDev Wiki</title>
<script>document.documentElement.className="client-js";RLCONF={"wgBreakFrames":false,"wgSeparatorTransformTable":["",""],"wgDigitTransformTable":["",""],"wgDefaultDateFormat":"dmy","wgMonthNames":["","January","February","March","April","May","June","July","August","September","October","November","December"],"wgRequestId":"a5192e4a4c420af1567f174e","wgCSPNonce":false,"wgCanonicalNamespace":"User","wgCanonicalSpecialPageName":false,"wgNamespaceNumber":2,"wgPageName":"User:Solar/Makefile","wgTitle":"Solar/Makefile","wgCurRevisionId":12959,"wgRevisionId":12959,"wgArticleId":3049,"wgIsArticle":true,"wgIsRedirect":false,"wgAction":"view","wgUserName":null,"wgUserGroups":["*"],"wgCategories":["Pages using deprecated source tags"],"wgPageContentLanguage":"en","wgPageContentModel":"wikitext","wgRelevantPageName":"User:Solar/Makefile","wgRelevantArticleId":3049,"wgIsProbablyEditable":false,"wgRelevantPageIsProbablyEditable":false,"wgRestrictionEdit":[],"wgRestrictionMove":[],"wgRelevantUserName":
"Solar","wgMFDisplayWikibaseDescriptions":{"search":false,"nearby":false,"watchlist":false,"tagline":false},"wgVisualEditor":{"pageLanguageCode":"en","pageLanguageDir":"ltr","pageVariantFallbacks":"en"},"wgVector2022PreviewPages":[],"wgMediaViewerOnClick":true,"wgMediaViewerEnabledByDefault":true,"wgEditSubmitButtonLabelPublish":false};RLSTATE={"site.styles":"ready","user.styles":"ready","user":"ready","user.options":"loading","ext.pygments":"ready","skins.vector.styles.legacy":"ready","ext.visualEditor.desktopArticleTarget.noscript":"ready","ext.DarkMode.styles":"ready"};RLPAGEMODULES=["site","mediawiki.page.ready","skins.vector.legacy.js","ext.visualEditor.desktopArticleTarget.init","ext.visualEditor.targetLoader","ext.DarkMode","ext.moderation.notify","ext.moderation.ve","ext.moderation.ajaxhook","ext.moderation.notify.desktop"];</script>
<script>(RLQ=window.RLQ||[]).push(function(){mw.loader.implement("user.options@12s5i",function($,jQuery,require,module){mw.user.tokens.set({"patrolToken":"+\\","watchToken":"+\\","csrfToken":"+\\"});});});</script>
<link rel="stylesheet" href="https://wiki.osdev.org/load.php?lang=en&amp;modules=ext.DarkMode.styles%7Cext.pygments%7Cext.visualEditor.desktopArticleTarget.noscript%7Cskins.vector.styles.legacy&amp;only=styles&amp;skin=vector"/>
<script async="" src="https://wiki.osdev.org/load.php?lang=en&amp;modules=startup&amp;only=scripts&amp;raw=1&amp;skin=vector"></script>
<meta name="ResourceLoaderDynamicStyles" content=""/>
<link rel="stylesheet" href="https://wiki.osdev.org/load.php?lang=en&amp;modules=site.styles&amp;only=styles&amp;skin=vector"/>
<meta name="generator" content="MediaWiki 1.39.7"/>
<meta name="format-detection" content="telephone=no"/>
<meta name="viewport" content="width=1000"/>
<link rel="icon" href="../favicon.ico"/>
<link rel="search" type="application/opensearchdescription+xml" href="../opensearch_desc.php" title="OSDev Wiki (en)"/>
<link rel="EditURI" type="application/rsd+xml" href="../api.php?action=rsd"/>
<link rel="alternate" type="application/atom+xml" title="OSDev Wiki Atom feed" href="https://wiki.osdev.org/index.php?title=Special:RecentChanges&amp;feed=atom"/>
</head>
<body class="mediawiki ltr sitedir-ltr mw-hide-empty-elt ns-2 ns-subject page-User_Solar_Makefile rootpage-User_Solar skin-vector action-view skin-vector-legacy vector-feature-language-in-header-enabled vector-feature-language-in-main-page-header-disabled vector-feature-language-alert-in-sidebar-disabled vector-feature-sticky-header-disabled vector-feature-sticky-header-edit-disabled vector-feature-table-of-contents-disabled vector-feature-visual-enhancement-next-disabled"><div id="mw-page-base" class="noprint"></div>
<div id="mw-head-base" class="noprint"></div>
<div id="content" class="mw-body" role="main">
	<a id="top"></a>
	<div id="siteNotice"></div>
	<div class="mw-indicators">
	</div>
	<h1 id="firstHeading" class="firstHeading mw-first-heading"><span class="mw-page-title-namespace">User</span><span class="mw-page-title-separator">:</span><span class="mw-page-title-main">Solar/Makefile</span></h1>
	<div id="bodyContent" class="vector-body">
		<div id="siteSub" class="noprint">From OSDev Wiki</div>
		<div id="contentSub"><span class="subpages">&lt; <a href="../User:Solar" title="User:Solar">User:Solar</a></span></div>
		<div id="contentSub2"></div>
		
		<div id="jump-to-nav"></div>
		<a class="mw-jump-link" href="Makefile#mw-head">Jump to navigation</a>
		<a class="mw-jump-link" href="Makefile#searchInput">Jump to search</a>
		<div id="mw-content-text" class="mw-body-content mw-content-ltr" lang="en" dir="ltr"><div class="mw-parser-output"><p><b>Note:</b> This isn't finished, just a rough draft. I didn't test this exhaustively, and will probably not do so anytime soon. But what's there already might be helpful.
</p>
<hr />
<hr />
<hr />
<p>Sometimes, your project consists of more than one binary: You have to build several libraries and executables from a single source tree, but with different compiler / linker settings. This, too, can be comfortably covered with a single Makefile, but requires some more involved syntax. One example is presented here; there are, of course, many other ways to achieve this.
</p><p>The basic idea is to create a subdirectory for each module (executable or library). In each these module subdirectories, the overall structure is identical:
</p>
<ul><li>module-specific settings are stored in a file <tt>build.mk</tt>;</li>
<li>headers with "global" project visibility (i.e., visible to other modules) are stored in <tt>includes</tt>;</li>
<li>all other headers and source files are located in <tt>src</tt>;</li>
<li>a directory <tt>obj</tt> exists for the compiler to put its object files.</li></ul>
<p>At the top level, there is a directory <tt>bin</tt> and a directory <tt>lib</tt> for binaries and libraries, respectively. A directory <tt>includes</tt> will eventually contain links to all the "global" headers. And, of course, there is our <tt>Makefile</tt>.
</p>
<pre>.
├── bar
│&#160;&#160; ├── build.mk
│&#160;&#160; ├── includes
│&#160;&#160; │&#160;&#160; └── global.h
│&#160;&#160; ├── obj
│&#160;&#160; └── src
│&#160;&#160;     ├── interface.c
│&#160;&#160;     ├── interface.h
│       └── main.c
├── baz
│   ├── build.mk
│   ├── includes
│   │   └── global.h
│   ├── obj
│   └── src
│       ├── hashmap.c
│       ├── hashmap.h
│       └── algorithm.c
├── bin
├── includes
├── lib
└── Makefile
</pre>
<p>The contents of the individual modules' <tt>build.mk</tt> files is similar to what is done in <tt>Makefile.am</tt> for Automake.
</p><p>Example for a binary module:
</p>
<pre># CFLAGS for module 'bar'
CFLAGS_bar&#160;:= 

# Executable to build in module 'bar'
bar_PROGRAM&#160;:= bar

# Libraries that the executable depends on:
bar_LIBRARIES&#160;:= libbaz.a

# Sources for the executable 'bar' (without headers)
bar_SOURCES&#160;:= interface.c main.c
</pre>
<p>Example for a library module:
</p>
<pre># CFLAGS for module 'baz'
CFLAGS_baz&#160;:=

# Archive / Lib to build in module 'baz'
baz_ARCHIVE&#160;:= libbaz.a

# Sources for the archive / lib 'libbaz.a' (without headers)
libbaz.a_SOURCES&#160;:= hashmap.c algorithm.c
</pre>
<p>The main Makefile makes heavy use of GNU make's template functionality. It might look daunting at first, but if you look at it carefully, you will see it is pretty straightforward, and easily adaptable or expandable.
</p>
<div class="mw-highlight mw-highlight-lang-bash mw-content-ltr" dir="ltr"><pre><span></span><span class="c1"># Modules in the project (you could &#39;find&#39; these, but stating</span>
<span class="c1"># them explicitly allows for subdirectories like &#39;tmp&#39; or &#39;doc&#39;</span>
<span class="c1"># without upsetting the build process.</span>
MODULES&#160;:<span class="o">=</span> bar baz

<span class="c1"># Global CFLAGS. Add to them if you must, but don&#39;t remove &#39;-MMD -I includes&#39;,</span>
<span class="c1"># which is used for header dependency tracking.</span>
CFLAGS_global&#160;:<span class="o">=</span> -MMD -I includes
<span class="c1"># Global ARFLAGS.</span>
ARFLAGS&#160;:<span class="o">=</span> rc

.PHONY: clean mrproper

<span class="c1"># Add whatever should be your default / global target.</span>
all:
	@echo <span class="s2">&quot;Default target.&quot;</span>

<span class="c1">###################################################################</span>
<span class="c1"># What follows are several templates (think &quot;functions&quot;), which are</span>
<span class="c1"># later instantiated for each registered module ($(1) being the</span>
<span class="c1"># module name).</span>
<span class="c1">###################################################################</span>

<span class="c1"># Including a module&#39;s build.mk</span>
define MK_template
include <span class="k">$(</span><span class="m">1</span><span class="k">)</span>/build.mk
endef

<span class="c1"># Setting a module&#39;s build rules for object files in &lt;module&gt;/obj.</span>
define RULES_template
<span class="k">$(</span><span class="m">1</span><span class="k">)</span>/obj/%.o: <span class="k">$(</span><span class="m">1</span><span class="k">)</span>/src/%.c
	<span class="nv">$$</span><span class="o">(</span>CC<span class="o">)</span> <span class="nv">$$</span><span class="o">(</span>CFLAGS<span class="o">)</span> <span class="nv">$$</span><span class="o">(</span>CFLAGS_global<span class="o">)</span> <span class="nv">$$</span><span class="o">(</span>CFLAGS_<span class="k">$(</span><span class="m">1</span><span class="k">)</span><span class="o">)</span> -c <span class="nv">$$</span>&lt; -o <span class="nv">$$</span>@
endef

<span class="c1"># Setting a module&#39;s build rules for executable targets.</span>
<span class="c1"># (Depending on its sources&#39; object files and any libraries.)</span>
<span class="c1"># Also adds a module&#39;s dependency files to the global list.</span>
define PROGRAM_template
DEPENDENCIES&#160;:<span class="o">=</span> <span class="k">$(</span>DEPENDENCIES<span class="k">)</span> <span class="k">$(</span>patsubst&#160;%,<span class="k">$(</span><span class="m">2</span><span class="k">)</span>/obj/%.d,<span class="k">$(</span>basename <span class="k">$($(</span><span class="m">1</span><span class="k">)</span>_SOURCES<span class="k">)))</span>
bin/<span class="k">$(</span><span class="m">1</span><span class="k">)</span>: <span class="k">$(</span>patsubst&#160;%,<span class="k">$(</span><span class="m">2</span><span class="k">)</span>/obj/%.o,<span class="k">$(</span>basename <span class="k">$($(</span><span class="m">1</span><span class="k">)</span>_SOURCES<span class="k">)))</span> <span class="k">$(</span>foreach library,<span class="k">$($(</span><span class="m">1</span><span class="k">)</span>_LIBRARIES<span class="k">)</span>,lib/<span class="k">$(</span>library<span class="k">))</span>
	<span class="nv">$$</span><span class="o">(</span>LD<span class="o">)</span> <span class="nv">$$</span><span class="o">(</span>LDFLAGS<span class="o">)</span> <span class="nv">$$</span><span class="o">(</span>LDFLAGS_<span class="k">$(</span><span class="m">2</span><span class="k">)</span><span class="o">)</span> <span class="nv">$$</span>^ -o <span class="nv">$$</span>@
endef

<span class="c1"># Setting a module&#39;s build rules for archive targets.</span>
<span class="c1"># (Depending on its sources&#39; object files.)</span>
define ARCHIVE_template
DEPENDENCIES&#160;:<span class="o">=</span> <span class="k">$(</span>DEPENDENCIES<span class="k">)</span> <span class="k">$(</span>patsubst&#160;%,<span class="k">$(</span><span class="m">2</span><span class="k">)</span>/obj/%.d,<span class="k">$(</span>basename <span class="k">$($(</span><span class="m">1</span><span class="k">)</span>_SOURCES<span class="k">)))</span>
lib/<span class="k">$(</span><span class="m">1</span><span class="k">)</span>: <span class="k">$(</span>patsubst&#160;%,<span class="k">$(</span><span class="m">2</span><span class="k">)</span>/obj/%.o,<span class="k">$(</span>basename <span class="k">$($(</span><span class="m">1</span><span class="k">)</span>_SOURCES<span class="k">)))</span>
	<span class="nv">$$</span><span class="o">(</span>AR<span class="o">)</span> <span class="nv">$$</span><span class="o">(</span>ARFLAGS<span class="o">)</span> <span class="nv">$$</span>@ <span class="nv">$$</span>?
endef

<span class="c1"># Linking a module&#39;s global includes into the global include directory</span>
<span class="c1"># (where they will be available as &lt;module&gt;/filename.h).</span>
define INCLUDE_template
ifeq <span class="o">(</span><span class="k">$(</span>wildcard includes/<span class="k">$(</span><span class="m">1</span><span class="k">))</span>,<span class="o">)</span>
    <span class="nv">$$</span><span class="o">(</span>shell ln -s ../<span class="k">$(</span><span class="m">1</span><span class="k">)</span>/includes includes/<span class="k">$(</span><span class="m">1</span><span class="k">)</span><span class="o">)</span>
endif
endef

<span class="c1"># Now, instantiating the templates for each module.</span>
<span class="k">$(</span>foreach module,<span class="k">$(</span>MODULES<span class="k">)</span>,<span class="k">$(</span><span class="nb">eval</span> include <span class="k">$(</span>module<span class="k">)</span>/build.mk<span class="k">))</span>
<span class="k">$(</span>foreach module,<span class="k">$(</span>MODULES<span class="k">)</span>,<span class="k">$(</span><span class="nb">eval</span> <span class="k">$(</span>call RULES_template,<span class="k">$(</span>module<span class="k">))))</span>
<span class="k">$(</span>foreach module,<span class="k">$(</span>MODULES<span class="k">)</span>,<span class="k">$(</span><span class="nb">eval</span> <span class="k">$(</span>foreach binary,<span class="k">$($(</span>module<span class="k">)</span>_PROGRAM<span class="k">)</span>,<span class="k">$(</span>call PROGRAM_template,<span class="k">$(</span>binary<span class="k">)</span>,<span class="k">$(</span>module<span class="k">)))))</span>
<span class="k">$(</span>foreach module,<span class="k">$(</span>MODULES<span class="k">)</span>,<span class="k">$(</span><span class="nb">eval</span> <span class="k">$(</span>foreach library,<span class="k">$($(</span>module<span class="k">)</span>_ARCHIVE<span class="k">)</span>,<span class="k">$(</span>call ARCHIVE_template,<span class="k">$(</span>library<span class="k">)</span>,<span class="k">$(</span>module<span class="k">)))))</span>
<span class="k">$(</span>foreach module,<span class="k">$(</span>MODULES<span class="k">)</span>,<span class="k">$(</span><span class="nb">eval</span> <span class="k">$(</span>call INCLUDE_template,<span class="k">$(</span>module<span class="k">))))</span>

<span class="c1"># Include the dependency files (generated by GCC&#39;s -MMD option)</span>
-include <span class="k">$(</span>sort <span class="k">$(</span>DEPENDENCIES<span class="k">))</span>

clean:
	<span class="k">$(</span>RM<span class="k">)</span> <span class="k">$(</span>foreach mod,<span class="k">$(</span>MODULES<span class="k">)</span>,<span class="k">$(</span>mod<span class="k">)</span>/obj/*.o<span class="k">)</span>

mrproper: clean
	<span class="k">$(</span>RM<span class="k">)</span> <span class="k">$(</span>foreach mod,<span class="k">$(</span>MODULES<span class="k">)</span>,<span class="k">$(</span>mod<span class="k">)</span>/obj/*.d<span class="k">)</span> includes/* bin/* lib/*
</pre></div>
<!-- 
NewPP limit report
Cached time: 20250211150519
Cache expiry: 86400
Reduced expiry: false
Complications: []
CPU time usage: 0.012 seconds
Real time usage: 0.144 seconds
Preprocessor visited node count: 13/1000000
Post‐expand include size: 0/2097152 bytes
Template argument size: 0/2097152 bytes
Highest expansion depth: 2/100
Expensive parser function count: 0/100
Unstrip recursion depth: 0/20
Unstrip post‐expand size: 9122/5000000 bytes
-->
<!--
Transclusion expansion time report (%,ms,calls,template)
100.00%    0.000      1 -total
-->

<!-- Saved in parser cache with key wikidb:pcache:idhash:3049-0!canonical and timestamp 20250211150519 and revision id 12959.
 -->
</div>
<div class="printfooter" data-nosnippet="">Retrieved from "<a dir="ltr" href="https://wiki.osdev.org/index.php?title=User:Solar/Makefile&amp;oldid=12959">https://wiki.osdev.org/index.php?title=User:Solar/Makefile&amp;oldid=12959</a>"</div></div>
		<div id="catlinks" class="catlinks" data-mw="interface"><div id="mw-normal-catlinks" class="mw-normal-catlinks"><a href="../Special:Categories" title="Special:Categories">Category</a>: <ul><li><a href="https://wiki.osdev.org/index.php?title=Category:Pages_using_deprecated_source_tags&amp;action=edit&amp;redlink=1" class="new" title="Category:Pages using deprecated source tags (page does not exist)">Pages using deprecated source tags</a></li></ul></div></div>
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
		
		<ul class="vector-menu-content-list"><li id="pt-login" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Special:UserLogin&amp;returnto=User%3ASolar%2FMakefile" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o"><span>Log in</span></a></li><li id="pt-darkmode" class="mw-list-item"><a href="Makefile#" class="ext-darkmode-link"><span>Dark mode</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="ca-nstab-user" class="selected mw-list-item"><a href="Makefile" title="View the user page [c]" accesskey="c"><span>User page</span></a></li><li id="ca-talk" class="new mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User_talk:Solar/Makefile&amp;action=edit&amp;redlink=1" rel="discussion" title="Discussion about the content page (page does not exist) [t]" accesskey="t"><span>Discussion</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="ca-view" class="selected mw-list-item"><a href="Makefile"><span>Read</span></a></li><li id="ca-viewsource" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Solar/Makefile&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e"><span>View source</span></a></li><li id="ca-history" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Solar/Makefile&amp;action=history" title="Past revisions of this page [h]" accesskey="h"><span>View history</span></a></li></ul>
		
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
		<a class="mw-wiki-logo" href="../index.html"
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
		
		<ul class="vector-menu-content-list"><li id="n-mainpage" class="mw-list-item"><a href="../index.html" title="Visit the main page [z]" accesskey="z"><span>Main Page</span></a></li><li id="n-portal" class="mw-list-item"><a href="http://forum.osdev.org/" rel="nofollow" title="About the project, what you can do, where to find things"><span>Forums</span></a></li><li id="n-FAQ" class="mw-list-item"><a href="../Category:FAQ"><span>FAQ</span></a></li><li id="n-OS-Projects" class="mw-list-item"><a href="../Projects"><span>OS Projects</span></a></li><li id="n-randompage" class="mw-list-item"><a href="https://wiki.osdev.org/Special:Random" title="Load a random page [x]" accesskey="x"><span>Random page</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="n-This-site" class="mw-list-item"><a href="../OSDevWiki:About"><span>This site</span></a></li><li id="n-Joining" class="mw-list-item"><a href="../OSDevWiki:Joining"><span>Joining</span></a></li><li id="n-Editing-help" class="mw-list-item"><a href="../OSDevWiki:Editing"><span>Editing help</span></a></li><li id="n-recentchanges" class="mw-list-item"><a href="../Special:RecentChanges" title="A list of recent changes in the wiki [r]" accesskey="r"><span>Recent changes</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="t-whatlinkshere" class="mw-list-item"><a href="../Special:WhatLinksHere/User:Solar/Makefile" title="A list of all wiki pages that link here [j]" accesskey="j"><span>What links here</span></a></li><li id="t-recentchangeslinked" class="mw-list-item"><a href="https://wiki.osdev.org/Special:RecentChangesLinked/User:Solar/Makefile" rel="nofollow" title="Recent changes in pages linked from this page [k]" accesskey="k"><span>Related changes</span></a></li><li id="t-contributions" class="mw-list-item"><a href="../Special:Contributions/Solar" title="A list of contributions by this user"><span>User contributions</span></a></li><li id="t-log" class="mw-list-item"><a href="../Special:Log/Solar"><span>Logs</span></a></li><li id="t-userrights" class="mw-list-item"><a href="../Special:UserRights/Solar"><span>View user groups</span></a></li><li id="t-specialpages" class="mw-list-item"><a href="../Special:SpecialPages" title="A list of all special pages [q]" accesskey="q"><span>Special pages</span></a></li><li id="t-print" class="mw-list-item"><a href="javascript:print();" rel="alternate" title="Printable version of this page [p]" accesskey="p"><span>Printable version</span></a></li><li id="t-permalink" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Solar/Makefile&amp;oldid=12959" title="Permanent link to this revision of this page"><span>Permanent link</span></a></li><li id="t-info" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Solar/Makefile&amp;action=info" title="More information about this page"><span>Page information</span></a></li></ul>
		
	</div>
</nav>

	
</div>

</div>

<footer id="footer" class="mw-footer" role="contentinfo" >
	<ul id="footer-info">
	<li id="footer-info-lastmod"> This page was last edited on 10 March 2012, at 07:38.</li>
	<li id="footer-info-0">This page has been accessed 711 times.</li>
</ul>

	<ul id="footer-places">
	<li id="footer-places-privacy"><a href="../OSDev_Wiki:Privacy_policy">Privacy policy</a></li>
	<li id="footer-places-about"><a href="../OSDev_Wiki:About">About OSDev Wiki</a></li>
	<li id="footer-places-disclaimer"><a href="../OSDev_Wiki:General_disclaimer">Disclaimers</a></li>
	<li id="footer-places-mobileview"><a href="https://wiki.osdev.org/index.php?title=User:Solar/Makefile&amp;mobileaction=toggle_view_mobile" class="noprint stopMobileRedirectToggle">Mobile view</a></li>
</ul>

	<ul id="footer-icons" class="noprint">
	<li id="footer-poweredbyico"><a href="https://www.mediawiki.org/"><img src="../resources/assets/poweredby_mediawiki_88x31.png" alt="Powered by MediaWiki" srcset="../resources/assets/poweredby_mediawiki_132x47.png 1.5x, ../resources/assets/poweredby_mediawiki_176x62.png 2x" width="88" height="31" loading="lazy"/></a></li>
</ul>

</footer>

<script>(RLQ=window.RLQ||[]).push(function(){mw.config.set({"wgPageParseReport":{"limitreport":{"cputime":"0.012","walltime":"0.144","ppvisitednodes":{"value":13,"limit":1000000},"postexpandincludesize":{"value":0,"limit":2097152},"templateargumentsize":{"value":0,"limit":2097152},"expansiondepth":{"value":2,"limit":100},"expensivefunctioncount":{"value":0,"limit":100},"unstrip-depth":{"value":0,"limit":20},"unstrip-size":{"value":9122,"limit":5000000},"timingprofile":["100.00%    0.000      1 -total"]},"cachereport":{"timestamp":"20250211150519","ttl":86400,"transientcontent":false}}});mw.config.set({"wgBackendResponseTime":254});});</script>
</body>
</html>