# THIS PROJECT IS DEPRECATED

phxeform is not maintained anymore. It maybe does not work in Evolution 1.1 anymore. Please fork it and bring it back to life, if you need it.

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
1. Since the form template is parsed by PHx, dropdown select boxes with Ditto are possible now. But be careful: those generated form elements could cause 'Incorrect value' if the elements are different before and after form post.
2. Since the form template is parsed by PHx, all placeholder are replaced in the chunk. If you really need to use a placeholder in this chunk – this is i.e. not nessesary for form field values – the tag should be changed from [+placeholder+] to ((placeholder)).
3. All snippet calls have to be called cached inside the chunks. Otherwise they are worked after the eForm call (tpl and thankyou chunk) or never (report and automessage chunk).
