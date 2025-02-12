<!DOCTYPE html>
<html class="client-nojs" lang="en" dir="ltr">
<head>
<meta charset="UTF-8"/>
<title>Makefile - OSDev Wiki</title>
<script>document.documentElement.className="client-js";RLCONF={"wgBreakFrames":false,"wgSeparatorTransformTable":["",""],"wgDigitTransformTable":["",""],"wgDefaultDateFormat":"dmy","wgMonthNames":["","January","February","March","April","May","June","July","August","September","October","November","December"],"wgRequestId":"724540978aca40f4e41bf88f","wgCSPNonce":false,"wgCanonicalNamespace":"","wgCanonicalSpecialPageName":false,"wgNamespaceNumber":0,"wgPageName":"Makefile","wgTitle":"Makefile","wgCurRevisionId":28008,"wgRevisionId":28008,"wgArticleId":1785,"wgIsArticle":true,"wgIsRedirect":false,"wgAction":"view","wgUserName":null,"wgUserGroups":["*"],"wgCategories":["Pages using duplicate arguments in template calls","Pages using deprecated source tags","Level 1 Tutorials","Tutorials","Build Tools"],"wgPageContentLanguage":"en","wgPageContentModel":"wikitext","wgRelevantPageName":"Makefile","wgRelevantArticleId":1785,"wgIsProbablyEditable":false,"wgRelevantPageIsProbablyEditable":false,
"wgRestrictionEdit":[],"wgRestrictionMove":[],"wgMFDisplayWikibaseDescriptions":{"search":false,"nearby":false,"watchlist":false,"tagline":false},"wgVisualEditor":{"pageLanguageCode":"en","pageLanguageDir":"ltr","pageVariantFallbacks":"en"},"wgVector2022PreviewPages":[],"wgMediaViewerOnClick":true,"wgMediaViewerEnabledByDefault":true,"wgEditSubmitButtonLabelPublish":false};RLSTATE={"site.styles":"ready","user.styles":"ready","user":"ready","user.options":"loading","ext.pygments":"ready","skins.vector.styles.legacy":"ready","ext.visualEditor.desktopArticleTarget.noscript":"ready","ext.DarkMode.styles":"ready"};RLPAGEMODULES=["site","mediawiki.page.ready","mediawiki.toc","skins.vector.legacy.js","ext.visualEditor.desktopArticleTarget.init","ext.visualEditor.targetLoader","mmv.head","mmv.bootstrap.autostart","ext.DarkMode","ext.moderation.notify","ext.moderation.ve","ext.moderation.ajaxhook","ext.moderation.notify.desktop"];</script>
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
<body class="mediawiki ltr sitedir-ltr mw-hide-empty-elt ns-0 ns-subject page-Makefile rootpage-Makefile skin-vector action-view skin-vector-legacy vector-feature-language-in-header-enabled vector-feature-language-in-main-page-header-disabled vector-feature-language-alert-in-sidebar-disabled vector-feature-sticky-header-disabled vector-feature-sticky-header-edit-disabled vector-feature-table-of-contents-disabled vector-feature-visual-enhancement-next-disabled"><div id="mw-page-base" class="noprint"></div>
<div id="mw-head-base" class="noprint"></div>
<div id="content" class="mw-body" role="main">
	<a id="top"></a>
	<div id="siteNotice"></div>
	<div class="mw-indicators">
	</div>
	<h1 id="firstHeading" class="firstHeading mw-first-heading"><span class="mw-page-title-main">Makefile</span></h1>
	<div id="bodyContent" class="vector-body">
		<div id="siteSub" class="noprint">From OSDev Wiki</div>
		<div id="contentSub"></div>
		<div id="contentSub2"></div>
		
		<div id="jump-to-nav"></div>
		<a class="mw-jump-link" href="Makefile#mw-head">Jump to navigation</a>
		<a class="mw-jump-link" href="Makefile#searchInput">Jump to search</a>
		<div id="mw-content-text" class="mw-body-content mw-content-ltr" lang="en" dir="ltr"><div class="mw-parser-output"><table style="font-size:95%; line-height:1.5em; padding:0.25em; float:right; margin: 0 0 8px 15px; clear:right; border:1px solid #aaaaaa; background:#eee; text-align:center;;"><tbody><tr><th>Difficulty level</th></tr><tr><td><a href="./File:Difficulty_1.png" class="image"><img alt="Difficulty 1.png" src="images/d/d3/Difficulty_1.png" decoding="async" width="46" height="14" data-file-width="46" data-file-height="14" /></a><br />Beginner</td></tr></tbody></table>
<p>A Makefile is a file which controls the 'make' command.  Make is available on virtually every platform, and is used to control the build process of a project.  Once a Makefile has been written for a project, make can easily and efficiently build your project and create the required output file(s).
</p><p>Make reads dependency information from your Makefile, figures out which output files need (re-)building (because they are either missing or older than their corresponding input files), executes the necessary commands to actually <i>do</i> the (re-)building. This compares favourably to "build batchfiles" that always rebuild the whole project.
</p><p>In doing this, make is not limited to any specific set of languages. Any tool that takes some input file and generates an output file can be controlled via make.
</p><p>A Makefile can offer several different "targets", which can be invoked by 'make &lt;target&gt;'. A frequently-used target is 'make clean', which removes any temporary files, or 'make install', which installs the project in its target location - but you can also give a specific output file as a target, and have make process only that file. Invoking make without a target parameter builds the default target (which is usually to build the whole project).
</p><p>But 'make' requires a well-written Makefile to do these things efficiently and reliably.
</p>
<div id="toc" class="toc" role="navigation" aria-labelledby="mw-toc-heading"><input type="checkbox" role="button" id="toctogglecheckbox" class="toctogglecheckbox" style="display:none" /><div class="toctitle" lang="en" dir="ltr"><h2 id="mw-toc-heading">Contents</h2><span class="toctogglespan"><label class="toctogglelabel" for="toctogglecheckbox"></label></span></div>
<ul>
<li class="toclevel-1 tocsection-1"><a href="Makefile#Makefile_tutorial"><span class="tocnumber">1</span> <span class="toctext">Makefile tutorial</span></a>
<ul>
<li class="toclevel-2 tocsection-2"><a href="Makefile#Basics"><span class="tocnumber">1.1</span> <span class="toctext">Basics</span></a></li>
<li class="toclevel-2 tocsection-3"><a href="Makefile#Automated_Testing"><span class="tocnumber">1.2</span> <span class="toctext">Automated Testing</span></a></li>
<li class="toclevel-2 tocsection-4"><a href="Makefile#File_Lists"><span class="tocnumber">1.3</span> <span class="toctext">File Lists</span></a>
<ul>
<li class="toclevel-3 tocsection-5"><a href="Makefile#Non-Source_Files"><span class="tocnumber">1.3.1</span> <span class="toctext">Non-Source Files</span></a></li>
<li class="toclevel-3 tocsection-6"><a href="Makefile#Project_Directories"><span class="tocnumber">1.3.2</span> <span class="toctext">Project Directories</span></a></li>
<li class="toclevel-3 tocsection-7"><a href="Makefile#Sources_and_Headers"><span class="tocnumber">1.3.3</span> <span class="toctext">Sources and Headers</span></a></li>
<li class="toclevel-3 tocsection-8"><a href="Makefile#Object_Files_and_Test_Driver_Executables"><span class="tocnumber">1.3.4</span> <span class="toctext">Object Files and Test Driver Executables</span></a></li>
<li class="toclevel-3 tocsection-9"><a href="Makefile#Dependencies,_pt._1"><span class="tocnumber">1.3.5</span> <span class="toctext">Dependencies, pt. 1</span></a></li>
<li class="toclevel-3 tocsection-10"><a href="Makefile#Distribution_Files"><span class="tocnumber">1.3.6</span> <span class="toctext">Distribution Files</span></a></li>
</ul>
</li>
<li class="toclevel-2 tocsection-11"><a href="Makefile#.PHONY"><span class="tocnumber">1.4</span> <span class="toctext">.PHONY</span></a></li>
<li class="toclevel-2 tocsection-12"><a href="Makefile#CFLAGS"><span class="tocnumber">1.5</span> <span class="toctext">CFLAGS</span></a></li>
<li class="toclevel-2 tocsection-13"><a href="Makefile#Rules"><span class="tocnumber">1.6</span> <span class="toctext">Rules</span></a>
<ul>
<li class="toclevel-3 tocsection-14"><a href="Makefile#Top-Level_Targets"><span class="tocnumber">1.6.1</span> <span class="toctext">Top-Level Targets</span></a></li>
<li class="toclevel-3 tocsection-15"><a href="Makefile#Automated_Testing,_pt._2"><span class="tocnumber">1.6.2</span> <span class="toctext">Automated Testing, pt. 2</span></a></li>
<li class="toclevel-3 tocsection-16"><a href="Makefile#Dependencies,_pt._2"><span class="tocnumber">1.6.3</span> <span class="toctext">Dependencies, pt. 2</span></a></li>
<li class="toclevel-3 tocsection-17"><a href="Makefile#Extracting_TODO_Statements"><span class="tocnumber">1.6.4</span> <span class="toctext">Extracting TODO Statements</span></a></li>
<li class="toclevel-3 tocsection-18"><a href="Makefile#Dependencies,_pt._3"><span class="tocnumber">1.6.5</span> <span class="toctext">Dependencies, pt. 3</span></a></li>
<li class="toclevel-3 tocsection-19"><a href="Makefile#Backups"><span class="tocnumber">1.6.6</span> <span class="toctext">Backups</span></a></li>
</ul>
</li>
<li class="toclevel-2 tocsection-20"><a href="Makefile#Summary"><span class="tocnumber">1.7</span> <span class="toctext">Summary</span></a></li>
</ul>
</li>
<li class="toclevel-1 tocsection-21"><a href="Makefile#Advanced_Techniques"><span class="tocnumber">2</span> <span class="toctext">Advanced Techniques</span></a>
<ul>
<li class="toclevel-2 tocsection-22"><a href="Makefile#Conditional_Evaluation"><span class="tocnumber">2.1</span> <span class="toctext">Conditional Evaluation</span></a></li>
<li class="toclevel-2 tocsection-23"><a href="Makefile#Multi-Target"><span class="tocnumber">2.2</span> <span class="toctext">Multi-Target</span></a></li>
</ul>
</li>
<li class="toclevel-1 tocsection-24"><a href="Makefile#See_Also"><span class="tocnumber">3</span> <span class="toctext">See Also</span></a>
<ul>
<li class="toclevel-2 tocsection-25"><a href="Makefile#Articles"><span class="tocnumber">3.1</span> <span class="toctext">Articles</span></a></li>
<li class="toclevel-2 tocsection-26"><a href="Makefile#External_Links"><span class="tocnumber">3.2</span> <span class="toctext">External Links</span></a></li>
</ul>
</li>
</ul>
</div>

<h1><span class="mw-headline" id="Makefile_tutorial">Makefile tutorial</span></h1>
<p>The 'make' manual will tell you about the hundreds of things you can do with a Makefile, but it doesn't give you an example for a <i>good</i> Makefile. The following examples are mostly shaped after the real-life <a rel="nofollow" class="external text" href="http://pdclib.e43.eu">PDCLib</a> Makefile I used at the time, and shows some of the "tricks" used therein that may not be that obvious to the make beginner.
</p><p>The Makefile creates only one project-wide linker library, but it should be easy to expand it for multiple binaries/libraries.
</p><p>(Note: There are several different flavours of make around, and POSIX defines a common denominator for them. This tutorial specifically targets GNU make. See the <a href="./Talk:Makefile#Which_make_to_target.3F" title="Talk:Makefile"> discussion page</a> for further info.) 
</p>
<h2><span class="mw-headline" id="Basics">Basics</span></h2>
<p>It is best practice to name your Makefile <code>Makefile</code> (without an extension), because when make is executed without any parameters, it will by default look for that file in the current directory. It also makes the file show up prominently on top of directory listings, at least on Unix machines.
</p><p>Generally speaking, a Makefile consists of <i>definitions</i> and <i>rules</i>.
</p><p>A <i>definition</i> declares a variable, and assigns a value to it. Its general syntax is <code>VARIABLE&#160;:= Value</code>.
</p><p><b>Note:</b> Frequently, you will see definitions using "=" instead of ":=". Such a definition will result in the assignment being evaluated <i>every time the variable is used</i>, while ":=" evaluates only once at the startup of make, which is usually what you want. Don't go changing other people's Makefiles, though - ":=" is a GNU extension to the make syntax.
</p><p>A rule defines a <i>target</i>, 0..n <i>dependencies</i>, and 0..n <i>commands</i>. The general idea is that <i>make</i> checks if the target (file) is there; if it isn't, or any of the dependencies is newer than the target, the commands are executed. The general syntax is:
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">target</span><span class="o">:</span> <span class="n">dependency</span>
	<span class="nb">command</span>
</pre></div>
<p>Both <i>dependency</i> and <i>command</i> are optional. There might be more than one <i>command</i> line, in which case they are executed in sequence.
</p><p>Note that commands <i>must be tab-indented</i>. If your editor environment is set to replace tabs with spaces, you have to undo that setting while editing a Makefile.
</p><p>What makes Makefiles so hard to read, for the beginner, is that it is not procedural in syntax (i.e., executed top-down), but functional: 'make' reads the <i>whole</i> Makefile, building a dependency tree, and then resolves the dependencies by hopping from rule to rule as necessary until the target you gave it on the command line has successfully been resolved.
</p><p>But let's not go into internal details of 'make'. This is a tutorial, not a man page, so it will show you how a real-life Makefile could be built, and the ideas behind each line.
</p>
<h2><span class="mw-headline" id="Automated_Testing">Automated Testing</span></h2>
<p>As the Makefile presented in this tutorial takes care of automated testing in a special way, this approach will be explained up front, so the related parts of the tutorial will make sense to you.
</p><p>As stated above, this tutorial is mainly derived from work done on the PDCLib project - which builds a single linker library. In that project, there is strictly one library function per source file. In each such source file, there is a test driver attached for conditional compilation, like this:
</p>
<div class="mw-highlight mw-highlight-lang-c mw-content-ltr" dir="ltr"><pre><span></span><span class="cp">#ifdef TEST</span>
<span class="kt">int</span><span class="w"> </span><span class="nf">main</span><span class="p">()</span><span class="w"></span>
<span class="p">{</span><span class="w"></span>
<span class="w">    </span><span class="cm">/* Test function code here */</span><span class="w"></span>
<span class="w">    </span><span class="k">return</span><span class="w"> </span><span class="n">NUMBER_OF_TEST_ERRORS</span><span class="p">;</span><span class="w"></span>
<span class="p">}</span><span class="w"></span>
<span class="cp">#endif</span>
</pre></div>
<p>Thus, when that source is compiled with <code>gcc -c</code>, it results in an object file with the library function code; when compiled with <code>gcc -DTEST</code>, it gives a test driver executable for that function. Returning the number of errors allows to do a grand total of errors encountered (see below).
</p>
<h2><span class="mw-headline" id="File_Lists">File Lists</span></h2>
<p>First, various "file lists" are assembled which are needed later in the Makefile.
</p>
<h3><span class="mw-headline" id="Non-Source_Files">Non-Source Files</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="c"># This is a list of all non-source files that are part of the distribution.</span>
<span class="nv">AUXFILES</span> <span class="o">:=</span> Makefile Readme.txt
</pre></div>
<p>Further down we will have a target <i>"dist"</i>, which packages all required files into a tarball for distribution. Lists of the sources and headers are created anyway. But there are commonly some auxiliary files, which are not referenced anywhere else in the Makefile but should still end up in the tarball. These are listed here.
</p>
<h3><span class="mw-headline" id="Project_Directories">Project Directories</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nv">PROJDIRS</span> <span class="o">:=</span> functions includes internals
</pre></div>
<p>Those are subdirectories holding the actual sources. (Or rather, searched for source files automatically, see below.) These could be subprojects, or whatever. We could simply search for source files starting with the current working directory, but if you like to have temporary subdirectories in your project (for testing, keeping reference sources etc.), that wouldn't work.
</p><p><i>Note that this is not a recursive approach; there is no Makefile in those subdirectories. Dependencies are hard enough to get right if you use one Makefile. At the bottom of this article is a link to a very good paper on the subject titled "recursive make considered harmful"; not only is a single Makefile easier to maintain (once you learned a couple of tricks), it can also be more efficient!</i>
</p>
<h3><span class="mw-headline" id="Sources_and_Headers">Sources and Headers</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nv">SRCFILES</span> <span class="o">:=</span> <span class="k">$(</span>shell find <span class="k">$(</span>PROJDIRS<span class="k">)</span> -type f -name <span class="s2">&quot;\*.c&quot;</span><span class="k">)</span>
<span class="nv">HDRFILES</span> <span class="o">:=</span> <span class="k">$(</span>shell find <span class="k">$(</span>PROJDIRS<span class="k">)</span> -type f -name <span class="s2">&quot;\*.h&quot;</span><span class="k">)</span>
</pre></div>
<p>It should be obvious to see what these two lines do. We now have a list of all source and header files in our project directories.
</p>
<h3><span class="mw-headline" id="Object_Files_and_Test_Driver_Executables">Object Files and Test Driver Executables</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nv">OBJFILES</span> <span class="o">:=</span> <span class="k">$(</span>patsubst&#160;%.c,%.o,<span class="k">$(</span>SRCFILES<span class="k">))</span>
<span class="nv">TSTFILES</span> <span class="o">:=</span> <span class="k">$(</span>patsubst&#160;%.c,%_t,<span class="k">$(</span>SRCFILES<span class="k">))</span>
</pre></div>
<p><i>OBJFILES</i> should be clear - a list of the source files, with <i>*.c</i> exchanged for <i>*.o</i>. <i>TSTFILES</i> does the same for the filename suffix <i>*_t</i>, which we will use for our test driver executables.
</p>
<dl><dd><i>Note: This tutorial initially used </i>*.t<i> instead of </i>*_t<i> here; this, however, kept us from handling dependencies for test driver executables seperately from those for library object files, which was necessary. See next section.</i></dd></dl>
<h3><span id="Dependencies.2C_pt._1"></span><span class="mw-headline" id="Dependencies,_pt._1">Dependencies, pt. 1</span></h3>
<p>Many people edit their Makefile every time they add/change an <i>#include</i> somewhere in their code. (Or forget to do so, resulting in some scratching of heads.)
</p><p>But most compilers - including <a href="GCC" title="GCC">GCC</a> - can do this automatically for you! Although the approach looks a little backward. For each source file, <i>GCC</i> will create a <i>dependency file</i> (which is canonically made to end in <i>*.d</i>), which contains a Makefile dependency rule listing that source file's includes. (And more, but see below.)
</p><p>We need two seperate sets of dependency files; one for the library objects, and one for the test driver executables (which usually have additional includes, and thus dependencies, not needed for the OBJFILES).
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nv">DEPFILES</span>    <span class="o">:=</span> <span class="k">$(</span>patsubst&#160;%.c,%.d,<span class="k">$(</span>SRCFILES<span class="k">))</span>
<span class="nv">TSTDEPFILES</span> <span class="o">:=</span> <span class="k">$(</span>patsubst&#160;%,%.d,<span class="k">$(</span>TSTFILES<span class="k">))</span>
</pre></div>
<h3><span class="mw-headline" id="Distribution_Files">Distribution Files</span></h3>
<p>The last list is the one with all sources, headers, and auxiliary files that should end up in a distribution tarball.
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nv">ALLFILES</span> <span class="o">:=</span> <span class="k">$(</span>SRCFILES<span class="k">)</span> <span class="k">$(</span>HDRFILES<span class="k">)</span> <span class="k">$(</span>AUXFILES<span class="k">)</span>
</pre></div>
<h2><span class="mw-headline" id=".PHONY">.PHONY</span></h2>
<p>The next one can take you by surprise. When you write a rule for <i>make clean</i>, and there happens to be a file named <i>clean</i> in your working directory, you might be surprised to find that <i>make</i> does nothing, because the "target" of the rule <i>clean</i> already exists. To avoid this, declare such rules as <i>phony</i>, i.e. disable the checking for a file of that name. These will be executed every time:
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">.PHONY</span><span class="o">:</span> <span class="n">all</span> <span class="n">clean</span> <span class="n">dist</span> <span class="n">check</span> <span class="n">testdrivers</span> <span class="n">todolist</span>
</pre></div>
<h2><span class="mw-headline" id="CFLAGS">CFLAGS</span></h2>
<p>If you thought <i>-Wall</i> does tell you everything, you'll be in for a rude surprise now. If you don't even use <i>-Wall</i>, shame on you.&#160;;)
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nv">WARNINGS</span> <span class="o">:=</span> -Wall -Wextra -pedantic -Wshadow -Wpointer-arith -Wcast-align <span class="se">\</span>
            -Wwrite-strings -Wmissing-prototypes -Wmissing-declarations <span class="se">\</span>
            -Wredundant-decls -Wnested-externs -Winline -Wno-long-long <span class="se">\</span>
            -Wconversion -Wstrict-prototypes
<span class="nv">CFLAGS</span> <span class="o">:=</span> -g -std<span class="o">=</span>gnu99 <span class="k">$(</span>WARNINGS<span class="k">)</span>
</pre></div>
<p>It is suggested to add new warning options to your project one at a time instead of all at once, to avoid getting swamped in warnings.&#160;;) These flags are merely recommendations for C work. If you use C++, you need different ones. Check out the GCC manual; each major compiler update changes the list of available warning options.
</p>
<h2><span class="mw-headline" id="Rules">Rules</span></h2>
<p>Now come the rules, in their typical backward manner (top-level rule first). The topmost rule is the default one (if 'make' is called without an explicit target). It is common practice to have the first rule called "all".
</p>
<h3><span class="mw-headline" id="Top-Level_Targets">Top-Level Targets</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">all</span><span class="o">:</span> <span class="n">pdclib</span>.<span class="n">a</span>

<span class="nf">pdclib.a</span><span class="o">:</span> <span class="k">$(</span><span class="nv">OBJFILES</span><span class="k">)</span>
	@ar r pdclib.a <span class="nv">$?</span>

<span class="nf">clean</span><span class="o">:</span>
	-@<span class="k">$(</span>RM<span class="k">)</span> <span class="k">$(</span>wildcard <span class="k">$(</span>OBJFILES<span class="k">)</span> <span class="k">$(</span>DEPFILES<span class="k">)</span> <span class="k">$(</span>TSTFILES<span class="k">)</span> pdclib.a pdclib.tgz<span class="k">)</span>

<span class="nf">dist</span><span class="o">:</span>
	@tar czf pdclib.tgz <span class="k">$(</span>ALLFILES<span class="k">)</span>
</pre></div>
<p>The <i>@</i> at the beginning of a line tells <i>make</i> to be quiet, i.e. not to echo the executed commands on the console prior to executing them. The Unix credo is "no news is good news". You don't get a list of processed files with <i>cp</i> or <i>tar</i>, either, so it's completely beyond me why developers chose to have their Makefiles churn out endless lists of useless garbage. One very practical advantage of shutting up <i>make</i> is that you actually get to <i>see</i> those compiler warnings, instead of having them drowned out by noise.
</p><p>The <i>-</i> at the beginning of a line tells <i>make</i> to continue even in case an error is encountered (default behaviour is to terminate the whole build).
</p><p>The <i>$(RM)</i> in the <i>clean</i> rule is the platform-independent command to remove a file.
</p><p>The <i>$?</i> in the <i>pdclib.a</i> rule is an internal variable, which <i>make</i> expands to list all dependencies to the rule <i>which are newer than the target</i>.
</p>
<h3><span id="Automated_Testing.2C_pt._2"></span><span class="mw-headline" id="Automated_Testing,_pt._2">Automated Testing, pt. 2</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">check</span><span class="o">:</span> <span class="n">testdrivers</span>
	-@rc<span class="o">=</span><span class="m">0</span><span class="p">;</span> <span class="nv">count</span><span class="o">=</span><span class="m">0</span><span class="p">;</span> <span class="se">\</span>
        <span class="k">for</span> file <span class="k">in</span> <span class="k">$(</span>TSTFILES<span class="k">)</span><span class="p">;</span> <span class="k">do</span> <span class="se">\</span>
            <span class="nb">echo</span> <span class="s2">&quot; TST     </span><span class="nv">$$</span><span class="s2">file&quot;</span><span class="p">;</span> ./<span class="nv">$$</span>file<span class="p">;</span> <span class="se">\</span>
            <span class="nv">rc</span><span class="o">=</span><span class="sb">`</span>expr <span class="nv">$$</span>rc + <span class="nv">$$</span>?<span class="sb">`</span><span class="p">;</span> <span class="nv">count</span><span class="o">=</span><span class="sb">`</span>expr <span class="nv">$$</span>count + <span class="m">1</span><span class="sb">`</span><span class="p">;</span> <span class="se">\</span>
        <span class="k">done</span><span class="p">;</span> <span class="se">\</span>
	echo<span class="p">;</span> <span class="nb">echo</span> <span class="s2">&quot;Tests executed: </span><span class="nv">$$</span><span class="s2">count  Tests failed: </span><span class="nv">$$</span><span class="s2">rc&quot;</span>

<span class="nf">testdrivers</span><span class="o">:</span> <span class="k">$(</span><span class="nv">TSTFILES</span><span class="k">)</span>
</pre></div>
<p>Call it crude, but it works beautifully for me. The leading <i>-</i> means that 'make' will not abort when encountering an error, but continue with the loop.
</p><p>The <i>echo " TST    $$file"</i> in there is useful in case you get a <i>SEGFAULT</i> or something like that from one of your test drivers. (Without echoing the drivers as they are executed, you would be at a loss as to which one crashed.)
</p>
<h3><span id="Dependencies.2C_pt._2"></span><span class="mw-headline" id="Dependencies,_pt._2">Dependencies, pt. 2</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="cp">-include $(DEPFILES) $(TSTDEPFILES)</span>
</pre></div>
<p>Further below, you will see how dependency files are <i>generated</i>. Here, we <i>include</i> all of them, i.e. make the dependencies listed in them part of our Makefile. Never mind that they might not even exist when we run our Makefile the first time - the leading "-" again suppresses the errors.
</p>
<h3><span class="mw-headline" id="Extracting_TODO_Statements">Extracting TODO Statements</span></h3>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">todolist</span><span class="o">:</span>
	-@for file <span class="k">in</span> <span class="k">$(</span>ALLFILES:Makefile<span class="o">=</span><span class="k">)</span><span class="p">;</span> <span class="k">do</span> fgrep -H -e TODO -e FIXME <span class="nv">$$</span>file<span class="p">;</span> <span class="k">done</span><span class="p">;</span> <span class="nb">true</span>
</pre></div>
<p>Taking all files in your project, with exception of the Makefile itself, this will <i>grep</i> all those <i>TODO</i> and <i>FIXME</i> comments from your files, and display them in the terminal. It is nice to be remembered of what is still missing before you do a release. To add another keyword, just insert another <code>-e keyword</code>.
</p>
<dl><dd><b>Note:</b> <i>$(ALLFILES:Makefile=) is a list of everything in $(ALLFILES), except for the string "Makefile" which is replaced with nothing (i.e., removed from the list). This avoids a self-referring match, where the string "TODO" in the grep command would find itself. (Of course, it also avoids finding any *real* TODO's in the Makefile, but there's always a downside.&#160;;-) )</i></dd></dl>
<h3><span id="Dependencies.2C_pt._3"></span><span class="mw-headline" id="Dependencies,_pt._3">Dependencies, pt. 3</span></h3>
<p>Now comes the dependency magic I talked about earlier. Note that this needs GCC 3.3 or newer.
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">%.o</span><span class="o">:</span>&#160;%.<span class="n">c</span> <span class="n">Makefile</span>
	@<span class="k">$(</span>CC<span class="k">)</span> <span class="k">$(</span>CFLAGS<span class="k">)</span> -MMD -MP -c $&lt; -o <span class="nv">$@</span>
</pre></div>
<p>Isn't it a beauty?&#160;;-)
</p><p>The <i>-MMD</i> flag generates the dependency file (%.d), which will hold (in Makefile syntax) rules making the <i>generated</i> file (%.o in this case) depend on the source file <i>and any non-system headers it includes</i>. That means the object file gets recreated automatically whenever relevant sources are touched. If you want to also depend on system headers (i.e., checking them for updates on each compile), use <i>-MD</i> instead. The <i>-MP</i> option adds empty dummy rules, which avoid errors should header files be removed from the filesystem.
</p><p>Compiling the object file actually looks like a side effect.&#160;;-) 
</p><p>Note that the dependency list of the rule includes the Makefile itself. If you changed e.g. the <i>CFLAGS</i> in the Makefile, you want them to be applied, don't you? Using the $&lt; macro ("first dependency") in the command makes sure we do not attempt to compile the Makefile as C source.
</p><p>Of course we also need a rule for generating the test driver executables (and their dependency files):
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nf">%_t</span><span class="o">:</span>&#160;%.<span class="n">c</span> <span class="n">Makefile</span> <span class="n">pdclib</span>.<span class="n">a</span>
	@<span class="k">$(</span>CC<span class="k">)</span> <span class="k">$(</span>CFLAGS<span class="k">)</span> -MMD -MP -DTEST $&lt; pdclib.a -o <span class="nv">$@</span>
</pre></div>
<p>Here you can see why test driver executables get a <i>*_t</i> suffix instead of a <i>*.t</i> extension: The <i>-MMD</i> option uses the basename (i.e., filename without extension) of the <i>compiled</i> file as basis for the dependency file. If we would compile the sources into <i>abc.o</i> and <i>abc.t</i>, the dependency files would both be named <i>abc.d</i>, overwriting each other.
</p><p>Other compilers differ a bit in their support for this, so look up their specifics when using something else than <i>GCC</i>.
</p>
<h3><span class="mw-headline" id="Backups">Backups</span></h3>
<p>Backing up your files is a perfect candidate of a task that should be automated. However, this is generally achieved through a <a href="Code_Management#Version_Control_Systems" title="Code Management">version control system</a>.
</p><p>Below is an example of a <i>backup</i> target, which creates a dated 7-Zip archive of the directory where the Makefile resides.
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="nv">THISDIR</span> <span class="o">:=</span> <span class="k">$(</span>shell basename <span class="sb">`</span><span class="nb">pwd</span><span class="sb">`</span><span class="k">)</span>
<span class="nv">TODAY</span> <span class="o">:=</span> <span class="k">$(</span>shell date +%Y-%m-%d<span class="k">)</span>
<span class="nv">BACKUPDIR</span> <span class="o">:=</span> projectBackups/<span class="k">$(</span>TODAY<span class="k">)</span>

<span class="nf">backup</span><span class="o">:</span> <span class="n">clean</span>
	@tar cf - ../<span class="k">$(</span>THISDIR<span class="k">)</span> <span class="p">|</span> 7za a -si ../<span class="k">$(</span>BACKUPDIR<span class="k">)</span>/<span class="k">$(</span>THISDIR<span class="k">)</span>.<span class="k">$(</span>TODAY<span class="k">)</span>_<span class="sb">`</span>date +%H%M<span class="sb">`</span>.tar.7z
</pre></div>
<h2><span class="mw-headline" id="Summary">Summary</span></h2>
<p>A well-written Makefile can make maintaining a code base much easier, as it can wrap complex command sequences into simple 'make' invocations. Especially for large projects, it also cuts back on compilation times when compared to a dumb "build.sh" script. And, once written, modifications to a well-written Makefile are seldom necessary.
</p>
<h1><span class="mw-headline" id="Advanced_Techniques">Advanced Techniques</span></h1>
<p>Some of the stuff we did above already <i>was</i> pretty advanced, and no mistake. But we needed those features for the basic yet convenient setup. Below you will find some even trickier stuff, which might not be for everybody but is immensely helpful <i>if</i> you need it.
</p>
<h2><span class="mw-headline" id="Conditional_Evaluation">Conditional Evaluation</span></h2>
<p>Sometimes it is useful to react on the existence or content of certain environment variables. For example, you might have to rely on the path to a certain framework being passed in FRAMEWORK_PATH. Perhaps the error message given by the compiler in case the variable is not set is not helpful, or it takes long until 'make' gets to the point where it actually detects the error. You want to fail early, and with a meaningful error message.
</p><p>Luckily, 'make' allows for conditional evaluation and manual error reporting, quite akin to the C preprocessor:
</p>
<div class="mw-highlight mw-highlight-lang-make mw-content-ltr" dir="ltr"><pre><span></span><span class="cp">ifndef FRAMEWORK_PATH</span>
    <span class="k">$(</span>error FRAMEWORK_PATH is not set. Please <span class="nb">set</span> to the path where you installed <span class="s2">&quot;Framework&quot;</span>.<span class="k">)</span>
<span class="cp">endif</span>

<span class="cp">ifneq ($(FRAMEWORK_PATH),/usr/lib/framework)</span>
    <span class="k">$(</span>warning FRAMEWORK_PATH is <span class="nb">set</span> to <span class="k">$(</span>FRAMEWORK_PATH<span class="k">)</span>, not /usr/lib/framework. Are you sure this is correct?<span class="k">)</span>
<span class="cp">endif</span>
</pre></div>
<h2><span class="mw-headline" id="Multi-Target">Multi-Target</span></h2>
<p>Preliminary work has been done to write an improved Makefile, which allows generating multiple binaries with individual settings while still being easy to configure and use. While this is not yet in "tutorial" format, commented source can be found <a href="./User:Solar/Makefile" title="User:Solar/Makefile"> here</a>.
</p>
<h1><span class="mw-headline" id="See_Also">See Also</span></h1>
<h3><span class="mw-headline" id="Articles">Articles</span></h3>
<ul><li><a href="./User:Solar/Makefile" title="User:Solar/Makefile">User:Solar/Makefile</a>, A more complex example capable of building multiple executables and libraries from a single Makefile.</li></ul>
<h3><span class="mw-headline" id="External_Links">External Links</span></h3>
<ul><li><a rel="nofollow" class="external text" href="http://jaws.rootdirectory.de">JAWS</a>, a pre-configured <a rel="nofollow" class="external text" href="http://www.cmake.org">CMake</a> setup which, while not geared toward OS development, is a definite step forward from "naked" Makefiles.</li>
<li><a rel="nofollow" class="external text" href="http://aegis.sourceforge.net/auug97.pdf">Recursive Make Considered Harmful</a> by Peter Miller<br />A paper detailing why the traditional approach of recursive make invocations harms performance and reliability.</li>
<li><a rel="nofollow" class="external text" href="http://www.xs4all.nl/~evbergen/nonrecursive-make.html">Implementing non-recursive make</a> by Emile van Bergen<br />Further input on the subject of non-recursive, low-maintenance Makefile creation.</li>
<li><a rel="nofollow" class="external text" href="http://www.gnu.org/software/make/manual/">Manual for GNU make</a></li>
<li><a rel="nofollow" class="external text" href="https://www.goodreads.com/book/show/583690.Managing_Projects_with_GNU_Make">Managing Projects with GNU Make</a>, the O'Reilly book on GNU Make</li></ul>
<hr />
<!-- 
NewPP limit report
Cached time: 20250212010832
Cache expiry: 86400
Reduced expiry: false
Complications: [show‐toc]
CPU time usage: 0.101 seconds
Real time usage: 2.477 seconds
Preprocessor visited node count: 238/1000000
Post‐expand include size: 340/2097152 bytes
Template argument size: 44/2097152 bytes
Highest expansion depth: 15/100
Expensive parser function count: 0/100
Unstrip recursion depth: 0/20
Unstrip post‐expand size: 10770/5000000 bytes
-->
<!--
Transclusion expansion time report (%,ms,calls,template)
100.00%    5.759      1 Template:Rating
100.00%    5.759      1 -total
 56.78%    3.270      2 Template:If
 47.42%    2.731      2 Template:Show1
 13.96%    0.804      2 Template:Eq
  6.59%    0.380      2 Template:Eq1
-->

<!-- Saved in parser cache with key wikidb:pcache:idhash:1785-0!canonical and timestamp 20250212010830 and revision id 28008.
 -->
</div>
<div class="printfooter" data-nosnippet="">Retrieved from "<a dir="ltr" href="https://wiki.osdev.org/index.php?title=Makefile&amp;oldid=28008">https://wiki.osdev.org/index.php?title=Makefile&amp;oldid=28008</a>"</div></div>
		<div id="catlinks" class="catlinks" data-mw="interface"><div id="mw-normal-catlinks" class="mw-normal-catlinks"><a href="./Special:Categories" title="Special:Categories">Categories</a>: <ul><li><a href="https://wiki.osdev.org/index.php?title=Category:Pages_using_duplicate_arguments_in_template_calls&amp;action=edit&amp;redlink=1" class="new" title="Category:Pages using duplicate arguments in template calls (page does not exist)">Pages using duplicate arguments in template calls</a></li><li><a href="https://wiki.osdev.org/index.php?title=Category:Pages_using_deprecated_source_tags&amp;action=edit&amp;redlink=1" class="new" title="Category:Pages using deprecated source tags (page does not exist)">Pages using deprecated source tags</a></li><li><a href="./Category:Level_1_Tutorials" title="Category:Level 1 Tutorials">Level 1 Tutorials</a></li><li><a href="./Category:Tutorials" title="Category:Tutorials">Tutorials</a></li><li><a href="./Category:Build_Tools" title="Category:Build Tools">Build Tools</a></li></ul></div></div>
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
		
		<ul class="vector-menu-content-list"><li id="pt-login" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Special:UserLogin&amp;returnto=Makefile" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o"><span>Log in</span></a></li><li id="pt-darkmode" class="mw-list-item"><a href="Makefile#" class="ext-darkmode-link"><span>Dark mode</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="ca-nstab-main" class="selected mw-list-item"><a href="Makefile" title="View the content page [c]" accesskey="c"><span>Page</span></a></li><li id="ca-talk" class="mw-list-item"><a href="./Talk:Makefile" rel="discussion" title="Discussion about the content page [t]" accesskey="t"><span>Discussion</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="ca-view" class="selected mw-list-item"><a href="Makefile"><span>Read</span></a></li><li id="ca-viewsource" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Makefile&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e"><span>View source</span></a></li><li id="ca-history" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Makefile&amp;action=history" title="Past revisions of this page [h]" accesskey="h"><span>View history</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="t-whatlinkshere" class="mw-list-item"><a href="./Special:WhatLinksHere/Makefile" title="A list of all wiki pages that link here [j]" accesskey="j"><span>What links here</span></a></li><li id="t-recentchangeslinked" class="mw-list-item"><a href="https://wiki.osdev.org/Special:RecentChangesLinked/Makefile" rel="nofollow" title="Recent changes in pages linked from this page [k]" accesskey="k"><span>Related changes</span></a></li><li id="t-specialpages" class="mw-list-item"><a href="./Special:SpecialPages" title="A list of all special pages [q]" accesskey="q"><span>Special pages</span></a></li><li id="t-print" class="mw-list-item"><a href="javascript:print();" rel="alternate" title="Printable version of this page [p]" accesskey="p"><span>Printable version</span></a></li><li id="t-permalink" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Makefile&amp;oldid=28008" title="Permanent link to this revision of this page"><span>Permanent link</span></a></li><li id="t-info" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Makefile&amp;action=info" title="More information about this page"><span>Page information</span></a></li></ul>
		
	</div>
</nav>

	

<nav id="p-lang" class="vector-menu mw-portlet mw-portlet-lang vector-menu-portal portal" aria-labelledby="p-lang-label" role="navigation"  >
	<h3
		id="p-lang-label"
		
		class="vector-menu-heading "
	>
		<span class="vector-menu-heading-label">In other languages</span>
	</h3>
	<div class="vector-menu-content">
		
		<ul class="vector-menu-content-list"><li class="interlanguage-link interwiki-de mw-list-item"><a href="http://www.lowlevel.eu/wiki/Makefile" title="Makefile – Deutsch" lang="de" hreflang="de" class="interlanguage-link-target"><span>Deutsch</span></a></li></ul>
		
	</div>
</nav>

</div>

</div>

<footer id="footer" class="mw-footer" role="contentinfo" >
	<ul id="footer-info">
	<li id="footer-info-lastmod"> This page was last edited on 9 July 2023, at 17:54.</li>
	<li id="footer-info-0">This page has been accessed 8,896 times.</li>
</ul>

	<ul id="footer-places">
	<li id="footer-places-privacy"><a href="./OSDev_Wiki:Privacy_policy">Privacy policy</a></li>
	<li id="footer-places-about"><a href="./OSDev_Wiki:About">About OSDev Wiki</a></li>
	<li id="footer-places-disclaimer"><a href="./OSDev_Wiki:General_disclaimer">Disclaimers</a></li>
	<li id="footer-places-mobileview"><a href="https://wiki.osdev.org/index.php?title=Makefile&amp;mobileaction=toggle_view_mobile" class="noprint stopMobileRedirectToggle">Mobile view</a></li>
</ul>

	<ul id="footer-icons" class="noprint">
	<li id="footer-poweredbyico"><a href="https://www.mediawiki.org/"><img src="resources/assets/poweredby_mediawiki_88x31.png" alt="Powered by MediaWiki" srcset="resources/assets/poweredby_mediawiki_132x47.png 1.5x, resources/assets/poweredby_mediawiki_176x62.png 2x" width="88" height="31" loading="lazy"/></a></li>
</ul>

</footer>

<script>(RLQ=window.RLQ||[]).push(function(){mw.config.set({"wgPageParseReport":{"limitreport":{"cputime":"0.101","walltime":"2.477","ppvisitednodes":{"value":238,"limit":1000000},"postexpandincludesize":{"value":340,"limit":2097152},"templateargumentsize":{"value":44,"limit":2097152},"expansiondepth":{"value":15,"limit":100},"expensivefunctioncount":{"value":0,"limit":100},"unstrip-depth":{"value":0,"limit":20},"unstrip-size":{"value":10770,"limit":5000000},"timingprofile":["100.00%    5.759      1 Template:Rating","100.00%    5.759      1 -total"," 56.78%    3.270      2 Template:If"," 47.42%    2.731      2 Template:Show1"," 13.96%    0.804      2 Template:Eq","  6.59%    0.380      2 Template:Eq1"]},"cachereport":{"timestamp":"20250212010832","ttl":86400,"transientcontent":false}}});mw.config.set({"wgBackendResponseTime":2586});});</script>
</body>
</html>