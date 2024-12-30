<div class="modulesCode moduleHTML">
    <h4 class="small text-light">HTML Editor</h4>

    <textarea class="codemirror" code="html" idCode="<?php echo $code->id_landing ?>" column="html_code"
        page="/<?php echo $code->url_landing ?>"><?php echo htmlspecialchars($code->html_code); ?></textarea>

</div>