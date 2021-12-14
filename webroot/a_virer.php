<pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dac239-trace').style.display = (document.getElementById('cakeErr5da9b85dac239-trace').style.display == 'none' ? '' : 'none');"><b>Warning</b> (512)</a>: Unable to emit headers. Headers sent in file=D:\wamp32_317\www\g2tere\src\Controller\AppController.php line=543 [<b>CORE\src\Http\ResponseEmitter.php</b>, line <b>51</b>]<div id="cakeErr5da9b85dac239-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dac239-code').style.display = (document.getElementById('cakeErr5da9b85dac239-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dac239-context').style.display = (document.getElementById('cakeErr5da9b85dac239-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr5da9b85dac239-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">if&nbsp;(</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">)&nbsp;{</span></span></code>
<span class="code-highlight"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">return&nbsp;</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">(</span><span style="color: #0000BB">$code</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$message</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$file</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$line</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$context</span><span style="color: #007700">);</span></span></code></span>
<code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">}</span></span></code></pre><pre id="cakeErr5da9b85dac239-context" class="cake-context" style="display: none;">$response = object(Cake\Http\Response) {

	&#039;status&#039; =&gt; (int) 200,
	&#039;contentType&#039; =&gt; &#039;application/json&#039;,
	&#039;headers&#039; =&gt; [
		&#039;Content-Type&#039; =&gt; [
			[maximum depth reached]
		],
		&#039;X-DEBUGKIT-ID&#039; =&gt; [
			[maximum depth reached]
		]
	],
	&#039;file&#039; =&gt; null,
	&#039;fileRange&#039; =&gt; [],
	&#039;cookies&#039; =&gt; object(Cake\Http\Cookie\CookieCollection) {},
	&#039;cacheDirectives&#039; =&gt; [],
	&#039;body&#039; =&gt; &#039;&#039;

}
$maxBufferLength = (int) 8192
$file = &#039;D:\wamp32_317\www\g2tere\src\Controller\AppController.php&#039;
$line = (int) 543
$message = &#039;Unable to emit headers. Headers sent in file=D:\wamp32_317\www\g2tere\src\Controller\AppController.php line=543&#039;</pre><pre class="stack-trace">Cake\Core\BasePlugin::{closure}() - ROOT\vendor\cakephp\debug_kit\config\bootstrap.php, line 42
Cake\Http\ResponseEmitter::emit() - CORE\src\Http\ResponseEmitter.php, line 51
Cake\Http\Server::emit() - CORE\src\Http\Server.php, line 140
[main] - ROOT\webroot\index.php, line 40</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dacdf1-trace').style.display = (document.getElementById('cakeErr5da9b85dacdf1-trace').style.display == 'none' ? '' : 'none');"><b>Warning</b> (2)</a>: Cannot modify header information - headers already sent by (output started at D:\wamp32_317\www\g2tere\src\Controller\AppController.php:543) [<b>CORE\src\Http\ResponseEmitter.php</b>, line <b>152</b>]<div id="cakeErr5da9b85dacdf1-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dacdf1-code').style.display = (document.getElementById('cakeErr5da9b85dacdf1-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dacdf1-context').style.display = (document.getElementById('cakeErr5da9b85dacdf1-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr5da9b85dacdf1-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">if&nbsp;(</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">)&nbsp;{</span></span></code>
<span class="code-highlight"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">return&nbsp;</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">(</span><span style="color: #0000BB">$code</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$message</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$file</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$line</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$context</span><span style="color: #007700">);</span></span></code></span>
<code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">}</span></span></code></pre><pre id="cakeErr5da9b85dacdf1-context" class="cake-context" style="display: none;">$response = object(Cake\Http\Response) {

	&#039;status&#039; =&gt; (int) 200,
	&#039;contentType&#039; =&gt; &#039;application/json&#039;,
	&#039;headers&#039; =&gt; [
		&#039;Content-Type&#039; =&gt; [
			[maximum depth reached]
		],
		&#039;X-DEBUGKIT-ID&#039; =&gt; [
			[maximum depth reached]
		]
	],
	&#039;file&#039; =&gt; null,
	&#039;fileRange&#039; =&gt; [],
	&#039;cookies&#039; =&gt; object(Cake\Http\Cookie\CookieCollection) {},
	&#039;cacheDirectives&#039; =&gt; [],
	&#039;body&#039; =&gt; &#039;&#039;

}
$reasonPhrase = &#039;OK&#039;</pre><pre class="stack-trace">Cake\Core\BasePlugin::{closure}() - ROOT\vendor\cakephp\debug_kit\config\bootstrap.php, line 42
header - [internal], line ??
Cake\Http\ResponseEmitter::emitStatusLine() - CORE\src\Http\ResponseEmitter.php, line 152
Cake\Http\ResponseEmitter::emit() - CORE\src\Http\ResponseEmitter.php, line 57
Cake\Http\Server::emit() - CORE\src\Http\Server.php, line 140
[main] - ROOT\webroot\index.php, line 40</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dad5c1-trace').style.display = (document.getElementById('cakeErr5da9b85dad5c1-trace').style.display == 'none' ? '' : 'none');"><b>Warning</b> (2)</a>: Cannot modify header information - headers already sent by (output started at D:\wamp32_317\www\g2tere\src\Controller\AppController.php:543) [<b>CORE\src\Http\ResponseEmitter.php</b>, line <b>185</b>]<div id="cakeErr5da9b85dad5c1-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dad5c1-code').style.display = (document.getElementById('cakeErr5da9b85dad5c1-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dad5c1-context').style.display = (document.getElementById('cakeErr5da9b85dad5c1-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr5da9b85dad5c1-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">if&nbsp;(</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">)&nbsp;{</span></span></code>
<span class="code-highlight"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">return&nbsp;</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">(</span><span style="color: #0000BB">$code</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$message</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$file</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$line</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$context</span><span style="color: #007700">);</span></span></code></span>
<code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">}</span></span></code></pre><pre id="cakeErr5da9b85dad5c1-context" class="cake-context" style="display: none;">$response = object(Cake\Http\Response) {

	&#039;status&#039; =&gt; (int) 200,
	&#039;contentType&#039; =&gt; &#039;application/json&#039;,
	&#039;headers&#039; =&gt; [
		&#039;Content-Type&#039; =&gt; [
			[maximum depth reached]
		],
		&#039;X-DEBUGKIT-ID&#039; =&gt; [
			[maximum depth reached]
		]
	],
	&#039;file&#039; =&gt; null,
	&#039;fileRange&#039; =&gt; [],
	&#039;cookies&#039; =&gt; object(Cake\Http\Cookie\CookieCollection) {},
	&#039;cacheDirectives&#039; =&gt; [],
	&#039;body&#039; =&gt; &#039;&#039;

}
$cookies = []
$values = [
	(int) 0 =&gt; &#039;application/json&#039;
]
$name = &#039;Content-Type&#039;
$first = true
$value = &#039;application/json&#039;</pre><pre class="stack-trace">Cake\Core\BasePlugin::{closure}() - ROOT\vendor\cakephp\debug_kit\config\bootstrap.php, line 42
header - [internal], line ??
Cake\Http\ResponseEmitter::emitHeaders() - CORE\src\Http\ResponseEmitter.php, line 185
Cake\Http\ResponseEmitter::emit() - CORE\src\Http\ResponseEmitter.php, line 58
Cake\Http\Server::emit() - CORE\src\Http\Server.php, line 140
[main] - ROOT\webroot\index.php, line 40</pre></div></pre><pre class="cake-error"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dae179-trace').style.display = (document.getElementById('cakeErr5da9b85dae179-trace').style.display == 'none' ? '' : 'none');"><b>Warning</b> (2)</a>: Cannot modify header information - headers already sent by (output started at D:\wamp32_317\www\g2tere\src\Controller\AppController.php:543) [<b>CORE\src\Http\ResponseEmitter.php</b>, line <b>185</b>]<div id="cakeErr5da9b85dae179-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dae179-code').style.display = (document.getElementById('cakeErr5da9b85dae179-code').style.display == 'none' ? '' : 'none')">Code</a> <a href="javascript:void(0);" onclick="document.getElementById('cakeErr5da9b85dae179-context').style.display = (document.getElementById('cakeErr5da9b85dae179-context').style.display == 'none' ? '' : 'none')">Context</a><pre id="cakeErr5da9b85dae179-code" class="cake-code-dump" style="display: none;"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">if&nbsp;(</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">)&nbsp;{</span></span></code>
<span class="code-highlight"><code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">return&nbsp;</span><span style="color: #0000BB">$previousHandler</span><span style="color: #007700">(</span><span style="color: #0000BB">$code</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$message</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$file</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$line</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$context</span><span style="color: #007700">);</span></span></code></span>
<code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">}</span></span></code></pre><pre id="cakeErr5da9b85dae179-context" class="cake-context" style="display: none;">$response = object(Cake\Http\Response) {

	&#039;status&#039; =&gt; (int) 200,
	&#039;contentType&#039; =&gt; &#039;application/json&#039;,
	&#039;headers&#039; =&gt; [
		&#039;Content-Type&#039; =&gt; [
			[maximum depth reached]
		],
		&#039;X-DEBUGKIT-ID&#039; =&gt; [
			[maximum depth reached]
		]
	],
	&#039;file&#039; =&gt; null,
	&#039;fileRange&#039; =&gt; [],
	&#039;cookies&#039; =&gt; object(Cake\Http\Cookie\CookieCollection) {},
	&#039;cacheDirectives&#039; =&gt; [],
	&#039;body&#039; =&gt; &#039;&#039;

}
$cookies = []
$values = [
	(int) 0 =&gt; &#039;4c122af7-8c1f-46ef-bc38-41283dc6f157&#039;
]
$name = &#039;X-DEBUGKIT-ID&#039;
$first = true
$value = &#039;4c122af7-8c1f-46ef-bc38-41283dc6f157&#039;</pre><pre class="stack-trace">Cake\Core\BasePlugin::{closure}() - ROOT\vendor\cakephp\debug_kit\config\bootstrap.php, line 42
header - [internal], line ??
Cake\Http\ResponseEmitter::emitHeaders() - CORE\src\Http\ResponseEmitter.php, line 185
Cake\Http\ResponseEmitter::emit() - CORE\src\Http\ResponseEmitter.php, line 58
Cake\Http\Server::emit() - CORE\src\Http\Server.php, line 140
[main] - ROOT\webroot\index.php, line 40</pre></div></pre>