<!DOCTYPE html>
<html class="client-nojs" lang="en" dir="ltr">
<head>
<meta charset="UTF-8"/>
<title>User:Johnburger/Demo/Demo.inc - OSDev Wiki</title>
<script>document.documentElement.className="client-js";RLCONF={"wgBreakFrames":false,"wgSeparatorTransformTable":["",""],"wgDigitTransformTable":["",""],"wgDefaultDateFormat":"dmy","wgMonthNames":["","January","February","March","April","May","June","July","August","September","October","November","December"],"wgRequestId":"c2514fb23ea4f27d19be5cca","wgCSPNonce":false,"wgCanonicalNamespace":"User","wgCanonicalSpecialPageName":false,"wgNamespaceNumber":2,"wgPageName":"User:Johnburger/Demo/Demo.inc","wgTitle":"Johnburger/Demo/Demo.inc","wgCurRevisionId":21406,"wgRevisionId":21406,"wgArticleId":3485,"wgIsArticle":true,"wgIsRedirect":false,"wgAction":"view","wgUserName":null,"wgUserGroups":["*"],"wgCategories":["Pages using deprecated source tags"],"wgPageContentLanguage":"en","wgPageContentModel":"wikitext","wgRelevantPageName":"User:Johnburger/Demo/Demo.inc","wgRelevantArticleId":3485,"wgIsProbablyEditable":false,"wgRelevantPageIsProbablyEditable":false,"wgRestrictionEdit":[],"wgRestrictionMove"
:[],"wgRelevantUserName":"Johnburger","wgMFDisplayWikibaseDescriptions":{"search":false,"nearby":false,"watchlist":false,"tagline":false},"wgVisualEditor":{"pageLanguageCode":"en","pageLanguageDir":"ltr","pageVariantFallbacks":"en"},"wgVector2022PreviewPages":[],"wgMediaViewerOnClick":true,"wgMediaViewerEnabledByDefault":true,"wgEditSubmitButtonLabelPublish":false};RLSTATE={"site.styles":"ready","user.styles":"ready","user":"ready","user.options":"loading","ext.pygments":"ready","skins.vector.styles.legacy":"ready","ext.visualEditor.desktopArticleTarget.noscript":"ready","ext.DarkMode.styles":"ready"};RLPAGEMODULES=["site","mediawiki.page.ready","skins.vector.legacy.js","ext.visualEditor.desktopArticleTarget.init","ext.visualEditor.targetLoader","ext.DarkMode","ext.moderation.notify","ext.moderation.ve","ext.moderation.ajaxhook","ext.moderation.notify.desktop"];</script>
<script>(RLQ=window.RLQ||[]).push(function(){mw.loader.implement("user.options@12s5i",function($,jQuery,require,module){mw.user.tokens.set({"patrolToken":"+\\","watchToken":"+\\","csrfToken":"+\\"});});});</script>
<link rel="stylesheet" href="https://wiki.osdev.org/load.php?lang=en&amp;modules=ext.DarkMode.styles%7Cext.pygments%7Cext.visualEditor.desktopArticleTarget.noscript%7Cskins.vector.styles.legacy&amp;only=styles&amp;skin=vector"/>
<script async="" src="https://wiki.osdev.org/load.php?lang=en&amp;modules=startup&amp;only=scripts&amp;raw=1&amp;skin=vector"></script>
<meta name="ResourceLoaderDynamicStyles" content=""/>
<link rel="stylesheet" href="https://wiki.osdev.org/load.php?lang=en&amp;modules=site.styles&amp;only=styles&amp;skin=vector"/>
<meta name="generator" content="MediaWiki 1.39.7"/>
<meta name="format-detection" content="telephone=no"/>
<meta name="viewport" content="width=1000"/>
<link rel="icon" href="../../favicon.ico"/>
<link rel="search" type="application/opensearchdescription+xml" href="../../opensearch_desc.php" title="OSDev Wiki (en)"/>
<link rel="EditURI" type="application/rsd+xml" href="../../api.php?action=rsd"/>
<link rel="alternate" type="application/atom+xml" title="OSDev Wiki Atom feed" href="https://wiki.osdev.org/index.php?title=Special:RecentChanges&amp;feed=atom"/>
</head>
<body class="mediawiki ltr sitedir-ltr mw-hide-empty-elt ns-2 ns-subject page-User_Johnburger_Demo_Demo_inc rootpage-User_Johnburger skin-vector action-view skin-vector-legacy vector-feature-language-in-header-enabled vector-feature-language-in-main-page-header-disabled vector-feature-language-alert-in-sidebar-disabled vector-feature-sticky-header-disabled vector-feature-sticky-header-edit-disabled vector-feature-table-of-contents-disabled vector-feature-visual-enhancement-next-disabled"><div id="mw-page-base" class="noprint"></div>
<div id="mw-head-base" class="noprint"></div>
<div id="content" class="mw-body" role="main">
	<a id="top"></a>
	<div id="siteNotice"></div>
	<div class="mw-indicators">
	</div>
	<h1 id="firstHeading" class="firstHeading mw-first-heading"><span class="mw-page-title-namespace">User</span><span class="mw-page-title-separator">:</span><span class="mw-page-title-main">Johnburger/Demo/Demo.inc</span></h1>
	<div id="bodyContent" class="vector-body">
		<div id="siteSub" class="noprint">From OSDev Wiki</div>
		<div id="contentSub"><span class="subpages">&lt; <a href="https://wiki.osdev.org/User:Johnburger" title="User:Johnburger">User:Johnburger</a>&lrm; | <a href="../Demo" title="User:Johnburger/Demo">Demo</a></span></div>
		<div id="contentSub2"></div>
		
		<div id="jump-to-nav"></div>
		<a class="mw-jump-link" href="Demo.inc#mw-head">Jump to navigation</a>
		<a class="mw-jump-link" href="Demo.inc#searchInput">Jump to search</a>
		<div id="mw-content-text" class="mw-body-content mw-content-ltr" lang="en" dir="ltr"><div class="mw-parser-output"><p>This file contains most of the configurable values used by the Demonstrator. You can modify other values, but you need a deeper understanding of what they are, and how they affect other things in the system, before you can change them willy-nilly. (If you only <em>willy</em> change them, they should work. Go to the full <em>nilly</em>, and I'm not responsible...)
</p>
<table class="wikitable">

<tbody><tr>
<th>Identifier
</th>
<th>Description
</th></tr>
<tr>
<td><code>BIOS.VGA.90x60</code>
</td>
<td>Defining this will make the Boot Code change the screen to 90x60 text mode instead of 80x50 (the default). Note that not every system supports this mode - the versions of VMware that I tried did, while my late-generation laptops didn't.
</td></tr>
<tr>
<td><code>Timer.Tick</code>
</td>
<td>Changing this changes how many times a second the Timer will interrupt the PC. The Demonstrator changes tasks on every Timer Tick (there's also a <code>Yield</code> function...), so you can change this value and watch what happens.
</td></tr>
<tr>
<td><code>Window.Width</code><br /><code>Window.Height</code>
</td>
<td>Changing these values has the effect of changing how many Tasks are created at run-time. Since each Task bounces a ball around its individual screen area, a larger area means fewer Tasks. A smaller area is intriguing: if it's too small to even draw a border, it doesn't bother; and if the area is 1x1, rather than bounce the ball it simply sits there and "rotates" - increments to show you that something is happening.
<p>An interesting demonstration is to enable <code>BIOS.VGA.90x60</code> (above), and set these to 1x1. The result is so many tasks that it overflows the maximum number of '386 hardware Tasks - at least, it does the way I've set them up. Each Task has its own LDT, which means there's only room for a little less than 4,100 Tasks.
</p>
</td></tr>
<tr>
<td><code>User.Ball</code><br /><code>User.BallColour</code><br /><code>User.FrameColour</code>
</td>
<td>These are merely:
<ul><li>The character representing the Ball that bounces around;</li>
<li>The value for the colour to use for the Ball;</li>
<li>The value for the colour to use for the Frame</li></ul>
</td></tr>
<tr>
<td><code>User.Delay</code>
</td>
<td>Changing this value merely alters the delay between updates of the Ball position. The code puts the CPU in a busy-waiting loop (which could be time-sliced away at any moment) before returning to work out the next position for the ball.
<p>There are two other scheduling techniques you can try, and they're both commented out in the <a href="User/Code" title="User:Johnburger/Demo/User/Code">User code</a>:
</p>
<ul><li>The Halt technique tells the CPU to Halt the current Task until the next interrupt. This is (of course) <em>very</em> unfair to the other Tasks:
<ul><li>"Hey! If you're not using the CPU, why can't I?"</li>
<li>The alternate argument is: "I'd use all of my timeslice anyway, just spinning my wheels. At least this way I'm not using CPU power..."</li></ul></li>
<li>The Yield technique tells the system to immediately switch to the next waiting Task, and don't wait for the Timer tick.</li></ul>
</td></tr></tbody></table>
<p><br />
</p>
<h2><span id="Demo.2FDemo.inc"></span><span class="mw-headline" id="Demo/Demo.inc"><code><a href="Demo" title="User:Johnburger/Demo/Demo">Demo</a>/Demo.inc</code></span></h2>
<div class="mw-highlight mw-highlight-lang-asm mw-content-ltr" dir="ltr"><pre><span></span><span class="c1">;</span>
<span class="c1">; Demo.inc</span>
<span class="c1">;</span>

<span class="c1">; These are definitions for the rest of the program. You can experiment by</span>
<span class="c1">; changing them. Some expect to be changed (these first few), while others</span>
<span class="c1">; will have far-reaching impacts.</span>
<span class="c1">;</span>

<span class="c1">; This %define changes things to invoke the BIOS to show more text:</span>
<span class="c1">;%define         BIOS.VGA.90x60&#160;; Allow use of 90x60 VGA (not universal!)</span>

<span class="c1">; Change these to (almost) whatever you&#39;d like. If you&#39;re too extreme, you&#39;ll</span>
<span class="c1">; get assemble-time errors. Others you won&#39;t know until you try...</span>
<span class="c1">; For example, Timer.Tick is limited on virtualisation programs like VMware,</span>
<span class="c1">; so that even programming ludicrous values will result in staid performance.</span>
<span class="c1">; However, on real hardware there isn&#39;t that sort of control. Go on, set the</span>
<span class="c1">; Timer to 1,000,000 times a second - I dare you!</span>
<span class="nf">Timer.Tick</span><span class="w">      </span><span class="no">EQU</span><span class="w">             </span><span class="mi">1000</span><span class="w">    </span><span class="c1">; Number of Timer Interrupts a second</span>
<span class="nf">Window.Width</span><span class="w">    </span><span class="no">EQU</span><span class="w">             </span><span class="mi">8</span><span class="w">       </span><span class="c1">; Width of each Task&#39;s Window</span>
<span class="nf">Window.Height</span><span class="w">   </span><span class="no">EQU</span><span class="w">             </span><span class="mi">6</span><span class="w">       </span><span class="c1">; Height of each Task&#39;s Window</span>

<span class="nf">User.Ball</span><span class="w">       </span><span class="no">EQU</span><span class="w">             </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Try 3: it is an OEM &#39;Heart&#39; symbol</span>
<span class="nf">User.BallColour</span><span class="w"> </span><span class="no">EQU</span><span class="w">             </span><span class="no">Dev.VGA.BlueBack</span><span class="w">  </span><span class="err">|</span><span class="w"> </span><span class="no">Dev.VGA.White</span><span class="w"></span>
<span class="nf">User.FrameColour</span><span class="w"> </span><span class="no">EQU</span><span class="w">            </span><span class="no">Dev.VGA.GreenBack</span><span class="w"> </span><span class="err">|</span><span class="w"> </span><span class="no">Dev.VGA.White</span><span class="w"></span>
<span class="nf">User.Delay</span><span class="w">      </span><span class="no">EQU</span><span class="w">             </span><span class="mi">0</span><span class="no">FFFFh</span><span class="w">  </span><span class="c1">; How long to &#39;idle&#39;the Bounce animation</span>

<span class="c1">; A useful pseudo-instruction to invoke the built-in Debugger - after it&#39;s set up!</span>
<span class="err">%</span><span class="nf">define</span><span class="w">         </span><span class="no">DEBUG</span><span class="w">           </span><span class="no">DB</span><span class="w"> </span><span class="mi">0</span><span class="no">CCh</span><span class="w"> </span><span class="c1">; INT 3 - NASM assembles this as 0CD 03h</span>

<span class="c1">; Another macro for debugging. Enable Single Step debugging - after it&#39;s set up!</span>
<span class="err">%</span><span class="nf">macro</span><span class="w">          </span><span class="no">TRACE</span><span class="w">           </span><span class="mi">0</span><span class="w"></span>
<span class="w">                </span><span class="nf">PUSHFD</span><span class="w"></span>
<span class="w">                </span><span class="nf">OR</span><span class="w">      </span><span class="no">WORD</span><span class="w">    </span><span class="p">[</span><span class="no">ESP</span><span class="p">],</span><span class="no">x86.EFlags.TF</span><span class="w"></span>
<span class="w">                </span><span class="nf">POPFD</span><span class="w"></span>
<span class="err">%</span><span class="nf">endmacro</span><span class="w"></span>

<span class="c1">; The following is the memory map for this Demonstration. Note that some of the</span>
<span class="c1">; areas are left over from the BIOS - I&#39;m simply working around those.</span>
<span class="nf">IVT.Base</span><span class="w">        </span><span class="no">EQU</span><span class="w">             </span><span class="no">x86.IVT.Base</span><span class="w"></span>
<span class="nf">IVT.Size</span><span class="w">        </span><span class="no">EQU</span><span class="w">             </span><span class="no">x86.IVT.Size</span><span class="w"></span>
<span class="nf">BDA.Base</span><span class="w">        </span><span class="no">EQU</span><span class="w">             </span><span class="no">BIOS.BDA.Base</span><span class="w"></span>
<span class="nf">BDA.Size</span><span class="w">        </span><span class="no">EQU</span><span class="w">             </span><span class="no">BIOS.BDA.Size</span><span class="w"></span>
<span class="nf">Data.Base</span><span class="w">       </span><span class="no">EQU</span><span class="w">             </span><span class="no">BDA.Base</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">BDA.Size</span><span class="w"></span>
<span class="nf">Data.Size</span><span class="w">       </span><span class="no">EQU</span><span class="w">             </span><span class="no">IDT.Base</span><span class="w"> </span><span class="p">-</span><span class="w"> </span><span class="no">Data.Base</span><span class="w"></span>

<span class="nf">IDT.Base</span><span class="w">        </span><span class="no">EQU</span><span class="w">             </span><span class="no">Code.Base</span><span class="w"> </span><span class="p">-</span><span class="w"> </span><span class="no">IDT.Max</span><span class="w"> </span><span class="c1">; Final address of IDT</span>
<span class="nf">IDT.Max</span><span class="w">         </span><span class="no">EQU</span><span class="w">             </span><span class="no">x86.Ints</span><span class="w"> </span><span class="p">*</span><span class="w"> </span><span class="no">x86.Desc_size</span><span class="w"> </span><span class="c1">; Full size of IDT</span>

<span class="nf">Code.Base</span><span class="w">       </span><span class="no">EQU</span><span class="w">             </span><span class="mi">1000</span><span class="no">h</span><span class="w"></span>

<span class="nf">Load.Base</span><span class="w">       </span><span class="no">EQU</span><span class="w">             </span><span class="no">IDT.Start</span><span class="w">       </span><span class="c1">; Load from start of defined IDT</span>
<span class="nf">Load.Max</span><span class="w">        </span><span class="no">EQU</span><span class="w">             </span><span class="mi">8</span><span class="w"> </span><span class="p">*</span><span class="w"> </span><span class="no">BIOS.Disk.Sector.Size</span><span class="w"> </span><span class="c1">; See Boot/Load.inc for why</span>

<span class="c1">; This will be the first-available RAM after everything else is initialised</span>
<span class="nf">Demo.First</span><span class="w">      </span><span class="no">EQU</span><span class="w">             </span><span class="no">Load.Base</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">Load.Size</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">GDT.Size</span><span class="w"> </span><span class="err">+</span><span class="w"> </span><span class="no">Exec.Stack.Size</span><span class="w"></span>

<span class="nf">Exec.Stack.Top</span><span class="w">  </span><span class="no">EQU</span><span class="w">             </span><span class="no">Demo.First</span><span class="w">      </span><span class="c1">; This is the TOP of an Expand-Down stack</span>
<span class="nf">Exec.Stack.Size</span><span class="w"> </span><span class="no">EQU</span><span class="w">             </span><span class="mi">1000</span><span class="no">h</span><span class="w"></span>

<span class="c1">; The PICs need to be re-based to get them away from the Intel-reserved interrupts</span>
<span class="nf">PIC.A.Base</span><span class="w">      </span><span class="no">EQU</span><span class="w">             </span><span class="mi">20</span><span class="no">h</span><span class="w"></span>
<span class="nf">PIC.B.Base</span><span class="w">      </span><span class="no">EQU</span><span class="w">             </span><span class="mi">28</span><span class="no">h</span><span class="w"></span>

<span class="c1">; See Ints/Timer.inc for a discussion on this (significant!) definition</span>
<span class="nf">System.TSS</span><span class="w">      </span><span class="no">EQU</span><span class="w">             </span><span class="no">x86.Desc.Mem.Gran.Avail</span><span class="w"></span>

<span class="c1">; This is the Descriptor for the Alias for the Descriptor Table that holds it</span>
<span class="nf">DT.Alias</span><span class="w">        </span><span class="no">EQU</span><span class="w">             </span><span class="no">x86.Desc_size</span><span class="w"></span>

<span class="c1">; The following structure is held in the first (NULL) GDT entry. It holds the</span>
<span class="c1">; information about the current state of the GDT: how big it is, and which</span>
<span class="c1">; entries have been returned.</span>
<span class="c1">; It is designed to enable the following instruction to be used:</span>
<span class="c1">;         LGDT  [GDT.Alloc.Pseudo]</span>
<span class="c1">; This is accomplished by:</span>
<span class="c1">; 1) Storing the linear base address of the GDT in .Pseudo.Base</span>
<span class="c1">; 2) Storing the current GDT size in .Pseudo.Size</span>
<span class="c1">; 3) As entries are freed, adding them to the .Free list (this uses the entries</span>
<span class="c1">;    themselves to store the next Free one, or 0 to end the list).</span>
<span class="w">                </span><span class="nf">STRUC</span><span class="w">           </span><span class="no">GDT.Alloc</span><span class="w"></span>
<span class="na">.Free</span><span class="w">           </span><span class="no">RESW</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Index to first Free Descriptor, or 0</span>
<span class="na">.Pseudo</span><span class="w">         </span><span class="no">EQU</span><span class="w">             </span><span class="no">$</span><span class="w">       </span><span class="c1">; You can do LGDT [GDT.Alloc.Pseudo]</span>
<span class="na">.Pseudo.Limit</span><span class="w">   </span><span class="no">EQU</span><span class="w">             </span><span class="no">$</span><span class="w"></span>
<span class="na">.Limit</span><span class="w">          </span><span class="no">RESW</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Last allocated Descriptor</span>
<span class="na">.Pseudo.Base</span><span class="w">    </span><span class="no">RESD</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; GDT.Base, as part of a pseudo-descriptor</span>
<span class="w">                </span><span class="nf">ENDSTRUC</span><span class="w"></span>

<span class="c1">; Like the GDT, the following structure is held in the first LDT entry - even</span>
<span class="c1">; though this is a valid entry according to Intel&#39;s definition.</span>
<span class="c1">; But by putting it there, and setting it up so that the important fields</span>
<span class="c1">; overlap the same fields in GDT.Alloc, the same code can be used to</span>
<span class="c1">; allocate Descriptors in either table.</span>
<span class="c1">; The &quot;important fields&quot; are simply .Free and .Limit</span>
<span class="w">                </span><span class="nf">STRUC</span><span class="w">           </span><span class="no">LDT.Alloc</span><span class="w"></span>
<span class="na">.Free</span><span class="w">           </span><span class="no">RESW</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Index to first Free Descriptor or 0</span>
<span class="na">.Limit</span><span class="w">          </span><span class="no">RESW</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Last (ever) allocated Descriptor</span>
<span class="w">                </span><span class="nf">RESB</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Reserved</span>
<span class="na">.Type</span><span class="w">           </span><span class="no">RESB</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Make sure any attempt at access fails!</span>
<span class="na">.GDT</span><span class="w">            </span><span class="no">RESW</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; This is the LDT&#39;s entry in the GDT</span>
<span class="w">                </span><span class="nf">ENDSTRUC</span><span class="w"></span>

<span class="c1">; As stated above, the two ?DT.Alloc structures have common elements:</span>
<span class="w">                </span><span class="nf">STRUC</span><span class="w">           </span><span class="no">DT.Alloc</span><span class="w"></span>
<span class="na">.Free</span><span class="w">           </span><span class="no">RESW</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Index to first Free Descriptor, or 0</span>
<span class="na">.Limit</span><span class="w">          </span><span class="no">RESW</span><span class="w">            </span><span class="mi">1</span><span class="w">       </span><span class="c1">; Last allocated Descriptor</span>
<span class="w">                </span><span class="nf">ENDSTRUC</span><span class="w"></span>
</pre></div>
<!-- 
NewPP limit report
Cached time: 20250212023428
Cache expiry: 86400
Reduced expiry: false
Complications: []
CPU time usage: 0.019 seconds
Real time usage: 0.156 seconds
Preprocessor visited node count: 7/1000000
Post‐expand include size: 0/2097152 bytes
Template argument size: 0/2097152 bytes
Highest expansion depth: 2/100
Expensive parser function count: 0/100
Unstrip recursion depth: 0/20
Unstrip post‐expand size: 14618/5000000 bytes
-->
<!--
Transclusion expansion time report (%,ms,calls,template)
100.00%    0.000      1 -total
-->

<!-- Saved in parser cache with key wikidb:pcache:idhash:3485-0!canonical and timestamp 20250212023428 and revision id 21406.
 -->
</div>
<div class="printfooter" data-nosnippet="">Retrieved from "<a dir="ltr" href="https://wiki.osdev.org/index.php?title=User:Johnburger/Demo/Demo.inc&amp;oldid=21406">https://wiki.osdev.org/index.php?title=User:Johnburger/Demo/Demo.inc&amp;oldid=21406</a>"</div></div>
		<div id="catlinks" class="catlinks" data-mw="interface"><div id="mw-normal-catlinks" class="mw-normal-catlinks"><a href="../../Special:Categories" title="Special:Categories">Category</a>: <ul><li><a href="https://wiki.osdev.org/index.php?title=Category:Pages_using_deprecated_source_tags&amp;action=edit&amp;redlink=1" class="new" title="Category:Pages using deprecated source tags (page does not exist)">Pages using deprecated source tags</a></li></ul></div></div>
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
		
		<ul class="vector-menu-content-list"><li id="pt-login" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=Special:UserLogin&amp;returnto=User%3AJohnburger%2FDemo%2FDemo.inc" title="You are encouraged to log in; however, it is not mandatory [o]" accesskey="o"><span>Log in</span></a></li><li id="pt-darkmode" class="mw-list-item"><a href="Demo.inc#" class="ext-darkmode-link"><span>Dark mode</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="ca-nstab-user" class="selected mw-list-item"><a href="Demo.inc" title="View the user page [c]" accesskey="c"><span>User page</span></a></li><li id="ca-talk" class="new mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User_talk:Johnburger/Demo/Demo.inc&amp;action=edit&amp;redlink=1" rel="discussion" title="Discussion about the content page (page does not exist) [t]" accesskey="t"><span>Discussion</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="ca-view" class="selected mw-list-item"><a href="Demo.inc"><span>Read</span></a></li><li id="ca-viewsource" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Johnburger/Demo/Demo.inc&amp;action=edit" title="This page is protected.&#10;You can view its source [e]" accesskey="e"><span>View source</span></a></li><li id="ca-history" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Johnburger/Demo/Demo.inc&amp;action=history" title="Past revisions of this page [h]" accesskey="h"><span>View history</span></a></li></ul>
		
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
		<a class="mw-wiki-logo" href="../../index.html"
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
		
		<ul class="vector-menu-content-list"><li id="n-mainpage" class="mw-list-item"><a href="../../index.html" title="Visit the main page [z]" accesskey="z"><span>Main Page</span></a></li><li id="n-portal" class="mw-list-item"><a href="http://forum.osdev.org/" rel="nofollow" title="About the project, what you can do, where to find things"><span>Forums</span></a></li><li id="n-FAQ" class="mw-list-item"><a href="../../Category:FAQ"><span>FAQ</span></a></li><li id="n-OS-Projects" class="mw-list-item"><a href="../../Projects"><span>OS Projects</span></a></li><li id="n-randompage" class="mw-list-item"><a href="https://wiki.osdev.org/Special:Random" title="Load a random page [x]" accesskey="x"><span>Random page</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="n-This-site" class="mw-list-item"><a href="../../OSDevWiki:About"><span>This site</span></a></li><li id="n-Joining" class="mw-list-item"><a href="../../OSDevWiki:Joining"><span>Joining</span></a></li><li id="n-Editing-help" class="mw-list-item"><a href="../../OSDevWiki:Editing"><span>Editing help</span></a></li><li id="n-recentchanges" class="mw-list-item"><a href="../../Special:RecentChanges" title="A list of recent changes in the wiki [r]" accesskey="r"><span>Recent changes</span></a></li></ul>
		
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
		
		<ul class="vector-menu-content-list"><li id="t-whatlinkshere" class="mw-list-item"><a href="../../Special:WhatLinksHere/User:Johnburger/Demo/Demo.inc" title="A list of all wiki pages that link here [j]" accesskey="j"><span>What links here</span></a></li><li id="t-recentchangeslinked" class="mw-list-item"><a href="https://wiki.osdev.org/Special:RecentChangesLinked/User:Johnburger/Demo/Demo.inc" rel="nofollow" title="Recent changes in pages linked from this page [k]" accesskey="k"><span>Related changes</span></a></li><li id="t-contributions" class="mw-list-item"><a href="../../Special:Contributions/Johnburger" title="A list of contributions by this user"><span>User contributions</span></a></li><li id="t-log" class="mw-list-item"><a href="../../Special:Log/Johnburger"><span>Logs</span></a></li><li id="t-userrights" class="mw-list-item"><a href="../../Special:UserRights/Johnburger"><span>View user groups</span></a></li><li id="t-specialpages" class="mw-list-item"><a href="../../Special:SpecialPages" title="A list of all special pages [q]" accesskey="q"><span>Special pages</span></a></li><li id="t-print" class="mw-list-item"><a href="javascript:print();" rel="alternate" title="Printable version of this page [p]" accesskey="p"><span>Printable version</span></a></li><li id="t-permalink" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Johnburger/Demo/Demo.inc&amp;oldid=21406" title="Permanent link to this revision of this page"><span>Permanent link</span></a></li><li id="t-info" class="mw-list-item"><a href="https://wiki.osdev.org/index.php?title=User:Johnburger/Demo/Demo.inc&amp;action=info" title="More information about this page"><span>Page information</span></a></li></ul>
		
	</div>
</nav>

	
</div>

</div>

<footer id="footer" class="mw-footer" role="contentinfo" >
	<ul id="footer-info">
	<li id="footer-info-lastmod"> This page was last edited on 29 August 2017, at 09:12.</li>
	<li id="footer-info-0">This page has been accessed 947 times.</li>
</ul>

	<ul id="footer-places">
	<li id="footer-places-privacy"><a href="../../OSDev_Wiki:Privacy_policy">Privacy policy</a></li>
	<li id="footer-places-about"><a href="../../OSDev_Wiki:About">About OSDev Wiki</a></li>
	<li id="footer-places-disclaimer"><a href="../../OSDev_Wiki:General_disclaimer">Disclaimers</a></li>
	<li id="footer-places-mobileview"><a href="https://wiki.osdev.org/index.php?title=User:Johnburger/Demo/Demo.inc&amp;mobileaction=toggle_view_mobile" class="noprint stopMobileRedirectToggle">Mobile view</a></li>
</ul>

	<ul id="footer-icons" class="noprint">
	<li id="footer-poweredbyico"><a href="https://www.mediawiki.org/"><img src="../../resources/assets/poweredby_mediawiki_88x31.png" alt="Powered by MediaWiki" srcset="../../resources/assets/poweredby_mediawiki_132x47.png 1.5x, ../../resources/assets/poweredby_mediawiki_176x62.png 2x" width="88" height="31" loading="lazy"/></a></li>
</ul>

</footer>

<script>(RLQ=window.RLQ||[]).push(function(){mw.config.set({"wgPageParseReport":{"limitreport":{"cputime":"0.019","walltime":"0.156","ppvisitednodes":{"value":7,"limit":1000000},"postexpandincludesize":{"value":0,"limit":2097152},"templateargumentsize":{"value":0,"limit":2097152},"expansiondepth":{"value":2,"limit":100},"expensivefunctioncount":{"value":0,"limit":100},"unstrip-depth":{"value":0,"limit":20},"unstrip-size":{"value":14618,"limit":5000000},"timingprofile":["100.00%    0.000      1 -total"]},"cachereport":{"timestamp":"20250212023428","ttl":86400,"transientcontent":false}}});mw.config.set({"wgBackendResponseTime":267});});</script>
</body>
</html>