phxeform
================================================================================

eForm event functions to allow PHx modifiers and snippet calls in eForm chunks for MODX Evolution.

Features:
--------------------------------------------------------------------------------
With this eForm event functions the use of PHx modifiers and snippet calls in eForm chunks is possible.

Installation:
--------------------------------------------------------------------------------
1. Upload all files into the new folder *assets/snippets/phxeform*
2. Create a new snippet called phxeform with the following snippet code
    ```<?php
    include (MODX_BASE_PATH . 'assets/snippets/phxeform/phxeform.snippet.php');
    ?>```

Usage
--------------------------------------------------------------------------------

Basic eForm call with phxeform:

```
[!eForm? &formid=`…` &tpl=`…` &report=`…` &eFormOnBeforeFormParse=`phxBeforeFormParse` &eFormOnBeforeMailSent=`phxBeforeMailSent` &runSnippet=`phxeform`!]
```

Notes:
--------------------------------------------------------------------------------
1. Since the form template is parsed by PHx, dropdown select boxes with Ditto are possible now. But be careful: those generated form elements could cause 'Incorrect value' error if the elements are different before and after form post.