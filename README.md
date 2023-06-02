<p class="has-line-data" data-line-start="0" data-line-end="1">Example Code</p>
<pre><code class="has-line-data" data-line-start="3" data-line-end="42" class="language-html"><span class="hljs-doctype">&lt;!DOCTYPE html&gt;</span>
<span class="hljs-tag">&lt;<span class="hljs-title">html</span> <span class="hljs-attribute">lang</span>=<span class="hljs-value">"en"</span>&gt;</span>
<span class="hljs-tag">&lt;<span class="hljs-title">head</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">meta</span> <span class="hljs-attribute">charset</span>=<span class="hljs-value">"UTF-8"</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">meta</span> <span class="hljs-attribute">http-equiv</span>=<span class="hljs-value">"X-UA-Compatible"</span> <span class="hljs-attribute">content</span>=<span class="hljs-value">"IE=edge"</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">meta</span> <span class="hljs-attribute">name</span>=<span class="hljs-value">"viewport"</span> <span class="hljs-attribute">content</span>=<span class="hljs-value">"width=device-width, initial-scale=1.0"</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">script</span> <span class="hljs-attribute">src</span>=<span class="hljs-value">"/api.js?render='Secreat Key'"</span>&gt;</span><span class="undefined"></span><span class="hljs-tag">&lt;/<span class="hljs-title">script</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">script</span> <span class="hljs-attribute">src</span>=<span class="hljs-value">"https://cdn.jsdelivr.net/npm/sweetalert2@11"</span>&gt;</span><span class="undefined"></span><span class="hljs-tag">&lt;/<span class="hljs-title">script</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">title</span>&gt;</span>Document<span class="hljs-tag">&lt;/<span class="hljs-title">title</span>&gt;</span>
<span class="hljs-tag">&lt;/<span class="hljs-title">head</span>&gt;</span>
<span class="hljs-tag">&lt;<span class="hljs-title">body</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">input</span> <span class="hljs-attribute">name</span>=<span class="hljs-value">"token"</span> <span class="hljs-attribute">type</span>=<span class="hljs-value">"hidden"</span> <span class="hljs-attribute">value</span>=<span class="hljs-value">""</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">input</span> <span class="hljs-attribute">name</span>=<span class="hljs-value">"idpass"</span> <span class="hljs-attribute">type</span>=<span class="hljs-value">"text"</span> <span class="hljs-attribute">value</span>=<span class="hljs-value">""</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">button</span> <span class="hljs-attribute">onclick</span>=<span class="hljs-value">"test()"</span>&gt;</span>test check<span class="hljs-tag">&lt;/<span class="hljs-title">button</span>&gt;</span>
<span class="hljs-tag">&lt;/<span class="hljs-title">body</span>&gt;</span>
<span class="hljs-tag">&lt;<span class="hljs-title">script</span>&gt;</span><span class="javascript">
    <span class="hljs-built_in">window</span>.onload= <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>) </span>{
        checker.ready(<span class="hljs-function"><span class="hljs-keyword">function</span> (<span class="hljs-params"></span>) </span>{
            checker.execute(<span class="hljs-string">'Secreat Key'</span>).then((token)=&gt;{
                <span class="hljs-keyword">var</span> tokenInput = <span class="hljs-built_in">document</span>.querySelector(<span class="hljs-string">'input[name="token"]'</span>);
                tokenInput.value = token;
            })
        });
    }
    <span class="hljs-function"><span class="hljs-keyword">function</span> <span class="hljs-title">test</span>(<span class="hljs-params"></span>)</span>{
        <span class="hljs-keyword">var</span> tokenInput = <span class="hljs-built_in">document</span>.querySelector(<span class="hljs-string">'input[name="token"]'</span>);
        <span class="hljs-keyword">var</span> idpass = <span class="hljs-built_in">document</span>.querySelector(<span class="hljs-string">'input[name="idpass"]'</span>);
        idpass = idpass.value.split(<span class="hljs-string">":"</span>)
        checker.login(idpass[<span class="hljs-number">0</span>],idpass[<span class="hljs-number">1</span>],tokenInput.value).then((result)=&gt;{
            <span class="hljs-keyword">if</span> (result){
                Swal.fire(result.ErrMsg)
            }
        })
    }
</span><span class="hljs-tag">&lt;/<span class="hljs-title">script</span>&gt;</span>
<span class="hljs-tag">&lt;/<span class="hljs-title">html</span>&gt;</span>
</code></pre>
