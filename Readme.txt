=== PHPdocX 14.5 ===
https://www.phpdocx.com/

PHPDOCX is a PHP library designed to dynamically generate reports in Word format (WordprocessingML).

The reports may be built from any available data source. The resulting documents remain fully editable in Microsoft Word (or any other compatible software like LibreOffice) and therefore the final users are able to modify them as necessary.

The formatting capabilities of the library allow the programmers to generate dynamically and programmatically all the standard rich formatting of a typical word processor.

This library also provides an easy method to generate documents in other standard formats such as PDF or HTML.

=== What's new on PHPdocX 14.5? ===

- phpdocx CLI command (Premium licenses):
    · Speed up development by generating phpdocx code skeletons automatically.
    · Skeletons generated for documents from scratch and using templates.
    · Check server settings.
    · Show automatic recommendations.
    · Return phpdocx information.
- PHP 8.3 support.
- New addLineSignature method to add line signatures (Premium licenses).
- New addTab method to add tabs.
- Native PDF to PNG transformation in the conversion plugin (Advanced and Premium licenses).
- Indexer extracts (Advanced and Premium licenses only):
    · Heading style names.
    · Input fields.
    · Merge fields.
- HTML to DOCX:
    · Improved line breaks between input tags.
    · HTML Extended: added support in stylesReplacementType when the paragraph has empty styles (Premium licenses).
    · HTML Extended: phpdocx_pagenumber can be added as inline content (Premium licenses).
- DOCX to HTML (Advanced and Premium licenses):
    · Improved handling left and right spacings in lists.
    · Lists square as list type.
    · Default left and right spacing styles applied when numberingAsParagraphs is true.
    · The includeBlankSpacesInEmptyParagraphs option applies to heading tags.
    · Excluded Symbol font-family in list items without a font-family.
    · New excludeNotSupportedImageTypes option to exclude adding not supported image types in web browsers. Default as true.
    · Clean fillColor extra information in textboxes when Theme colors are used.
    · majorHAnsi and minorHAnsi font family styles are parsed and applied from the asciiTheme attribute.
    · basedOn table styles.
    · Exact tr height styles in tables.
- Native DOCX to PDF (Advanced and Premium licenses):
    · Supported partial numbering styles.
    · Clean fillColor extra information in textboxes when Theme colors are used.
    · majorHAnsi and minorHAnsi font family styles are parsed and applied from the asciiTheme attribute.
    · basedOn table styles.
    · Exact tr height styles in tables.
    · Improved center and right alignments applied to tables.
- New shapes and options in addShape: straightArrow, arrowLeft, arrowRight, customShapeType, opacity, rotation, extraShapeStyles, relativeToHorizontal, relativeToVertical.
- New option in addText to parse tabs: parseTabs.
- Tracking supported in addTab and addLineSignature methods (Premium licenses).
- setTemplateSymbol and ProcessTemplate generate a new CreateDocxFromTemplate::$regExprVariableSymbols value automatically from the placeholder symbols when needed.
- New options in addTextBox to set margins, position, z-index, relativeToHorizontal and relativeToVertical styles.
- Endnotes, footnotes and comments internal IDs are set using sequential unique values to work with DOCX readers that don't follow the OOXML standard correctly.
- Improved the parseMode option when working with placeholders added in text boxes and placeholder symbols use text box symbols.
- New escapeshellarg option in the conversion plugin based on LibreOffice to escape the source string (Advanced and Premium licenses).
- DOCXCustomizer doesn't need existing row styles when updating trPr styles (Premium licenses).
- Reordered internal XML files in the default base structure template to return Microsoft Word 2007+ mime type (Premium licenses).
- Removed a PHP Warning with PHP 8 when all body contents are deleted using removeWordContent.
- Removed a mb_convert_encoding deprecated message when transforming HTML with PHP 8.2 or newer.
- Corrections in the internal phpdoc documentation.
- Added an extra check when generating new relationships to handle DOCX documents without valid relationship contents.
- Added inline r and wp namespaces to images and links to handle DOCX documents that don't include correct default namespaces.
- The page-of type added with addPageNumber supports working as an inline WordFragment.
- Updated TCPDF to apply the latest patches available.
- Parsing a DOCX shows the file name in the Exception if a file can't be read as a ZIP file.

14 VERSION

- New AI module to work with DOCX documents: GPT OpenAI and phpdocx integrations (Premium licenses).
    · Extract keywords (phpdocx, GPT).
    · Generate content from description (GPT).
    · Check spelling (phpdocx).
    · Grammar correction (GPT).
    · Summarize contents (phpdocx, GPT).
    · Translate contents (GPT).
- New addHeaderSection and addFooterSection methods to add headers and footers into specific sections (Advanced and Premium licenses).
- Performance improvements. The core of the library uses an average of 10% less memory.
- HTML to DOCX:
    · Table tags allow applying autofit using the table-layout style.
    · Cell tags in tables allow applying white-space noWrap style.
    · Apply multiple text-decoration styles to the same content.
    · Added 'data-outline-level: none' as new style for heading contents in CSS Extended (Premium licenses).
    · Set &amp;#9; to add tabs using HTML Extended (Premium licenses).
    · Added 'data-fit-text' as new style in cell contents to CSS Extended (Premium licenses).
    · New HTML Extended tag: phpdocx_ole (Premium licenses).
    · HTML Extended phpdocx_endnote and phpdocx_footnote tags support applying mark styles (Premium licenses).
    · HTML Extended phpdocx_comment, phpdocx_endnote and phpdocx_footnote tags support applying pStyle and rStyle attributes (Premium licenses).
- Drupal 10 module: new module to use phpdocx with Drupal 10 (Advanced and Premium licenses).
- New styles for endnote and footnote marks: highlight, underline, backgroundColor.
- modifyInputFields supports setting header and footer as targets.
- Strict mode supported in the DOCXStructure class. Strict documents are detected automatically to use them with phpdocx methods.
- New options in addTextBox to apply border styles: dashStyle and lineStyle.
- New writeProtection option added in docxSettings and modifyDocxSettings methods to set readonly setting.
- DOCX to HTML (Advanced and Premium licenses):
    · Support of conditional table styles and the tblLook tag.
    · Improvements transforming table styles without internal pPr and rPr styles.
- Native DOCX to PDF (Advanced and Premium licenses):
    · Support of conditional table styles.
    · Improvements transforming table styles without internal pPr and rPr styles.
- Sign classes avoid generating partial signed files in the latest revisions of MS Office. SignDocx uses DOCXStructure internally (Premium licenses).
- New stylesType option in getWordStyles to get styles information from style types.
- DOCXCustomizer supports rtl and bidi options (Premium licenses).
- Tracking supported in embedHTML and replaceVariableByHTML methods (Premium licenses).
- The conversion plugin based on LibreOffice supports generating PDF/A-2 and PDF/A-3 documents.
- Added a check while applying theme styles using addChart to avoid setting legend styles if the legend doesn't exist (Premium licenses).
- DOCXUtilites: new unusedFiles option in optimizeDocx to remove unused files. Removed the compressionMethod option in this same method. (Advanced and Premium licenses).
- Added a new internal check to avoid duplicated PHPDOCX internal styles when the same DOCX template is opened multiple times.
- Clone methods (cloneWordContent and cloneBlock) generate new id and name attributes for drawing object non-visual property tags (Advanced and Premium licenses).
- New PhpdocxLogger::$errorReporting public static variable to set a custom error reporting value. Default as E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED.
- PHP 8.2 and newer PHP versions use mb_convert_encoding when setEncodeUTF8 is enabled.
- New useFixedAnnotationPositions option in PDF methods to improve working with PDF internal link annotations using PDF readers that don't detect all PDF contents automatically (Advanced and Premium licenses).
- DOCXStructure and in-memory DOCX documents supported in optimizeDocx (Advanced and Premium licenses).
- DOCXStructure supported as return object in optimizeTemplate, modifyDocxSettings, optimizeDocx, searchAndColor, searchAndHighlight, setLineNumbering, searchAndReplace, searchAndRemove, parseCheckboxes, removeChapter, removeLineNumbering, watermarkDocx, watermarkRemove, replaceChartData, sign (Premium licenses).
- Improved mergeDocx when working with notes that include external relationships (Advanced and Premium licenses).
- Replaced utf8_encode with mb_convert_encoding when using PHP 8.2 to force encoding contents to UTF-8.
- Added a new XmlUtilities class.

13.5 VERSION

- New addOLE method to embed OLE objects (docx, xlsx, pptx, doc, xls and ppt files).
- New getTemplateVariablesType method to return template variables and their types (text, table, list, image) (Advanced and Premium licenses).
- New replaceBlock method (Advanced and Premium licenses).
- New features in cloneBlock (Advanced and Premium licenses):
    · Improved cloneBlock when using block placeholders with parent elements.
    · Added images as new key to replace image placeholders when cloning blocks.
- The deleteTemplateBlock method has been renamed to deleteBlock and includes two delete types: block (default), inline. The deleteTemplateBlock method is available as alias of deleteBlock without the new parameter.
- New parseMode option in CreateDocxFromTemplate to get template placeholders and repair internal placeholders. The parse mode is slower than the default one, but it's more accurate when the template includes placeholder symbols as regular contents.
- Improvements in addComment, addEndnote and addFootnote:
    · WordFragments can be used in the textDocument option.
    · pStyle and rStyle new options to change the default values.
- New resourceMode option added in addImage and replacePlaceholderImage methods to add images using image resources (GD).
- HTML to DOCX:
    · Supported inches and cms to set dimensions when transforming images.
    · Improved transforming comments, endnotes and footnotes as inline contents using HTML Extended. New data-type (block or inline) attribute (Premium licenses).
    · Multiple comments, endnotes and footes can be added to the same content using HTML Extended (Premium licenses).
    · New HTML Extended tags: phpdocx_citation, phpdocx_bibliography (Premium licenses).
    · Improved working with list override styles as sublevels using HTML Extended (Premium licenses).
    · The empty paragraph added as default in empty cells includes a default spacing style.
- Native DOCX to HTML:
    · Chart support: bar (group, stack and percent), column (group, stack and percent), pie, doughnut and line charts. Plotly JS library (MIT license) is used as default chart library.
    · New includeContentTypes option to include or avoid transforming specific content types: images, charts.
    · Supported pPr and rPr styles in custom table styles.
    · Empty font families values are not added.
- New options to style charts with addChart (Premium licenses):
    · Theme: new position option in serDataLabels.
    · Theme: new valueDataLabels option to customize labels by position.
- Adding captions in images and tables:
    · Supported position (below and above) option when adding captions.
    · Improved generation of autonumeric values when the captions use the same style name.
    · New option added to set keepNext.
- New stylesReplacementTypeOverwrite option in replaceVariableByHTML and replaceVariableByWordFragment methods to overwrite existing placeholder styles when using the mixPlaceholderStyles option (Advanced and Premium licenses).
- Supported dompdf 2 in the native conversion plugin (Advanced and Premium licenses).
- DOCXStructure and in-memory DOCX documents supported in DOCXUtilites methods: modifyDocxSettings, parseCheckboxes, removeChapter, replaceChartData, searchAndColor, searchAndHighlight, searchAndRemove, searchAndReplace, setLineNumbering (Advanced and Premium licenses).
- DOCXCustomizer supports numbering as target (Premium licenses).
- Supported AppImage format when using the conversion plugin based on LibreOffice (Advanced and Premium licenses).
- DOCXStructureFromStream removes the temp file automatically after parsing it (Premium licenses).
- The addStructuredDocumentTag method supports working as an inline WordFragment.
- MultiMerge supports OLE objects and multiple list level overrides (Advanced and Premium licenses).
- New information key in Indexer that contains DOCX extra information (variant, macros...) (Advanced and Premium licenses).
- Improved handle DOCX templates that use uppercase ContentType extensions and placeholders with non ASCII characters.
- Improved searchAndHighlight, searchAndColor and searchAndReplace when content paragraphs to be updated starts with protected XML characters or not standard double quotation marks (Advanced and Premium licenses).
- Indexer gets paragraph tags to avoid extra empty blank spaces when returning text contents (Advanced and Premium licenses).

13.0 VERSION

- Compiled mode (Premium licenses):
    · Linux (64-bit and ARM64), Windows (64-bit) and macOS (64-bit).
    · Replace lists, tables, texts and checkboxes.
    · Remove placeholders.
    · Get placeholders and styles.
- New PDF indexer method to get information from PDF files (Advanced and Premium licenses).
- PHP 8.2 support.
- HTML to DOCX:
    · New CSS selector supported: ~ .
    · Added 'data-font-size: initial' as new style in text contents to CSS Extended (Premium licenses).
    · Improved transforming br tags when being added before list tags.
    · Added new issets when reading CSS styles.
    · Added an extra check when adding images without a src attribute to avoid a PHP Warning using PHP 8.
- The static variables $_preprocessed, $_templateSymbolStart, $_templateSymbolEnd and $_templateBlockSymbol available in the CreateDocxFromTemplate class have been changed to class attributes. Added getter and setter methods for _preprocessed: getPreprocessed and setPreprocessed.
- Optimized the replacePlaceholderImage method when working with documents with many images.
- Optimized BulkProcessing when working with documents with many images (Premium licenses).
- DOCXUtilities: new searchAndColor method to search and color text strings (Advanced and Premium licenses).
- DOCXUtilities: searchAndReplace, searchAndRemove and searchAndHighlight methods allow setting headers and footers as scopes (Advanced and Premium licenses).
- Native DOCX to PDF (Advanced and Premium licenses):
    · Headers and footers support: default header/footer type, contents and styles supported in the document body, page number, page total.
    · Replaced empty paragraphs with &nbsp; paragraphs to avoid hiding them in the output. Added a new includeBlankSpacesInEmptyParagraphs option to avoid this default behavior.
    · Replaced &nbsp; with<br> when the includeBlankSpacesInEmptyParagraphs is enabled to keep empty paragraphs.
    · Use &nbsp; to set tabs instead of a margin-left style.
    · Added #fff as border color in table styles when nil border is used.
    · Added UTF-8 as meta charset.
- Native DOCX to HTML (Advanced and Premium licenses):
    · Replaced &nbsp; with <br> when the includeBlankSpacesInEmptyParagraphs is enabled to keep empty paragraphs.
- The importHeadersAndFooters method has been improved when working with multiple contents that include external relationships.
- DOCXCustomizer: added color support in run content types (Premium licenses).
- Bulk processing allows using the parseLineBreaks option in replaceList (Premium licenses).
- Added new PHPDOCX_VERSION const in CreateDocx to get the phpdocx version.
- MultiMerge: new importEmbeddedFonts option to import embedded fonts in the DOCX documents to be merged and supported OLE objects not using bin extensions (Advanced and Premium licenses).
- New typeCustom option in createListStyle to set custom types such as 001.
- Added support for in-memory documents in protectDOCX, changeStatusComments and importHeadersAndFooters methods (Premium licenses).
- CryptoPHPDOCX: removed external files (Premium licenses).
- Optimized TCPDF class and improved when working with indirect objects (Advanced and Premium licenses).
- Clone document source in splitDocx to avoid overwriting contents when using DOCXStructure objects (Premium licenses).
- Added the cellBackgroundColor option to createTableStyle.
- New resolution option in addSVG to set the resolution used by ImageMagick.
- New parseLineBreaks option in replaceListVariable with multiple levels.
- Updated the algorithm used to embed fonts (Advanced and Premium licenses).
- Added libxml_use_internal_errors when importing HTML to hide the PHP warnings shown by specific custom error levels when no standard tags are used with the PHP DOM loadHTML method.
- Removed @ to hide automatically XML warnings related to missing XML namespaces in the following classes and methods: CreateDocx, CreateDocxFromTemplate, Fonts, ThemeCharts, BulkProcessing, WordFragmentExtended. Added required namespaces when the XML contents are generated and libxml_use_internal_errors/libxml_clear_errors methods.
- Removed CreateChartImageJpgraph and CreateChartImageEzComponents classes. Only used in previous versions by the deprecated conversion plugin based on OpenOffice to transform charts to images (Advanced and Premium licenses).
- XLSXUtilities: splitXlsx cleans activeTab if set (Premium licenses).
- Improved working with temp files. Generated a specific class.
- Updated placeholder names used internally by phpdocx to generate XML contents adding '__PHX=' prefixes.
- CreateDocxFromTemplate allows setting a custom base DOCX.
- New setRTL example added to the packages.

12.5 VERSION

- New method to modify merge fields: modifyMergeFields (Advanced and Premium licenses).
- cloneBlock allows cloning the same block multiple times and adding variables to replace them by text strings or WordFragments (Advanced and Premium licenses).
- PHP 8.1 support.
- Theme charts with addChart new options: serDataLabels (formatCode, position, showCategory, showLegendKey, showPercent, showSeries and showValue) (Premium licenses).
- New options in addChart: gapWidth and overlap for bar and column charts.
- Support multiple comments, endnotes and footnotes in the same content using addComment, addEndnote and addFootnote methods.
- watermarkDocx allows adding multiline texts and applying bold and italic styles (Advanced and Premium licenses).
- watermarkPdf improvements when auto centering watermarks and working with multiple sizes and orientations in the same PDF, supports setting width and height values when adding an image as watermark (Advanced and Premium licenses).
- HTML to DOCX: a tag wrapping images adds hyperlink element (hlinkClick) to the image.
- HTML Extended: allow mixing standard HTML tags and HTML Extended tags, replace 0xa0 characters by blank spaces (Premium licenses).
- CSS Extended: new data-highlight style to apply a highlight style (Premium licenses).
- DocxUtilities: searchAndReplace, searchAndRemove and searchAndHighlight methods allow using arrays (Advanced and Premium licenses).
- PPTXUtilities and XLSXUtilities: new splitPptx and splitXlsx methods (Premium licenses).
- PPTXUtilities and XLSXUtilities: improved searchAndReplace methods to allow replacing parts of string contents (Premium licenses).
- MultiMerge supports links with mixed IDs and anchors and OLE objects embedded in equations (Advanced and Premium licenses).
- Tracking supports inline replacements when using replaceVariableByWordFragment (Premium licenses).
- Added new XML namespaces to the default base template used in mergeDocx and mergeDocxAt (Advanced and Premium licenses).
- inline-block replacement type can be used with the same placeholder name more than once (Premium licenses).
- replacePlaceholderImage sets a new random ID to the replaced image
- Native DOCX to HTML (Advanced and Premium licenses):
    · RTL: paragraphs (textDirection, rtl, bidi styles), run-of-text (rtl style)
    · comments, endnotes, and footnotes are added inside their own section tags with a specific class.
    · Lists allow using custom symbols (Wingdings font) as list-style-type, circle type is supported.
    · Simple fields: AUTHOR, COMMENTS, LASTSAVEDBY, TITLE.
    · Tables: direction (btLr, tbLrV, tbRl, tbRlV), cell padding styles.
    · Textboxes: margin-top, default border when none is set.
    · Sections: columns.
    · Tracked contents: ins and del tags.
    · Highlight style added as w:pPr/w:rPr style.
- Native DOCX to PDF (Advanced and Premium licenses):
    · comments, endnotes, and footnotes are added inside their own section tags with a specific class.
    · Simple fields: AUTHOR, COMMENTS, LASTSAVEDBY, TITLE.
    · Tables: cell padding styles.
    · Textboxes: margin-top, default border when none is set.
    · Tracked contents: ins and del tags.
    · Highlight style added as w:pPr/w:rPr style.
- DOCXCustomizer: added keepLines and keepNext support (Premium licenses).
- Bulk processing: replaceText allows replacing multiple placeholders inside the same w:t tag (Premium licenses).
- Repairing placeholders in template methods apply the xml:space="preserve" attribute in all cases.
- Added suppressLineNumbers option to addDateAndHour, addFormElement, addHeading, addText and createParagraphStyle methods.
- Added emboss, noProof, outline and shadow options to createCharacterStyle, addHeading and addText methods.
- Added primaryStyle option to the createParagraphStyle method to set a custom paragraph style as important to be displayed in the styles dialog (use with the semiHidden option set as true).
- Added a new static variable (HTML2WordML::$scaleImageFactor) to customize the default scale factor when adding images from HTML (7200 as default).
- Added vertAlign option to the createCharacterStyle method.
- Updated the included base template files to use MS Word MIME type.
- replaceTableVariable includes the addExtraSiblingNodes option to include nodes without placeholders when using multiple rows with placeholders.
- Improved replacing placeholders by WordFragments when doing inline type replacements to keep existing rPr styles in contents after placeholders.
- The mergeDocx method doesn't add webSettings and theme1 relationships if the first DOCX to be merged doesn't include them (Advanced and Premium licenses).
- The addTextBox method generates an internal v:shapetype tag automatically, useful for latest versions of LibreOffice.
- Close ZIP files at the end of the following methods: parseDocx in DOCXStructure, generateBaseWordNumbering, addChart (externalXLSX option), importHeadersAndFooters and importChartStyle.

12.0 VERSION

- MS Word 2021 support.
- New methods to insert citations, sources and bibliographies: addCitation, addSource, addBibliography (Advanced and Premium licenses).
- New SignPDFPlus feature to sign the same PDF document more than once. PHP 5.6 or newer is required (Premium licenses).
- replaceVariableByWordFragment new stylesReplacementType option to keep and mix existing placeholder pPr and rPr styles (Premium licenses).
- New method to insert SVG contents: addSVG (ImageMagick PHP extension is required).
- New inline-block type replacement in replaceVariableByWordFragment and replaceVariableByHTML methods to replace placeholders keeping inline and block elements and placeholder styles (Premium licenses).
- New option in mergeDocx to rename styles of the DOCX documents to be merged: renameStyles (Advanced and Premium licenses).
- Drupal 9 module: A new module to use phpdocx with Drupal 9 (Advanced and Premium licenses).
- Removed phpseclib to sign documents using SignDOCX, SignXLSX and SignPPTX. OpenSSL functions from PHP are now used to increase PEM formats compatibility. (Premium licenses).
- Improved working with East Asian fonts with the addText method.
- Improved mergeDocx when working with embedded images in shapes, SVG images, numbering styles applied to custom styles, multiple altChunk tag, hyperlinks in images tags with the same ID, external charts (Advanced and Premium licenses).
- addImage and replacePlaceholderImage methods support base64 images and set a default 96 dpi if the image to be added has a 0 dpi and no custom dpi is set.
- addShape supports adding image contents in shapes.
- replaceListVariable allows using sub-arrays.
- HTML to DOCX: no direction style is set as default, added a descr default value when adding base64 images to avoid a PHP warning with PHP 8, improved parseAnchors options when the anchor tag is not added in a paragraph, float casting to sizes to avoid a warning when using PHP 8 and not valid values.
- DOCX to HTML: w:vanish, better support for cell margins when only table margins are set, supported on/off, 1/0 and true/false values for w:pPr and w:rPr styles, improved hyperlinks transformation, improved border sizes (Advanced and Premium licenses).
- DOCX to PDF using native conversion plugin: endnotes, footnotes and comments support (appear at the end of the document) w:vanish, better support for cell margins when only table margins are set, supported on/off, 1/0 and true/false values for w:pPr and w:rPr styles, improved hyperlinks transformation, improved list margins, improved border sizes (Advanced and Premium licenses).
- New option in replacePlaceholderImage to replace images in shapes: replaceShapes.
- DOCX documents without a section tag are automatically fixed.
- addSection and modifyPageLayout include new options to position, start, restart and format endnotes and footnotes, and allow generating multiple sections with more than one column applying custom widths and spaces.
- importListStyle and importStyles methods support importing linked numbering styles.
- New bookmarkName option added to captions in addImage and addTable methods to set a custom name to the caption bookmark.
- DOCXCustomizer: added strike, dstrike and vanish support (Premium licenses).
- Handle autonumeric id by the style name when adding captions: Caption, Figure, Table...
- Bookmarks wrap the full content of the caption when adding a caption (image or table).
- Indexer extracts signatures and sources information (Advanced and Premium licenses).
- Tracking supports accepting and rejecting section changes (w:sectPrChange tag) (Premium licenses).
- The addText method adds a parseLineBreaks option to make possible to parse line breaks ('\n', "\n", '\n\r', "\n\r" and others).
- Added an extra check in getWordStyles to avoid null Exceptions if some DOCX styles are missing (Advanced and Premium licenses).
- Bulk processing allows adding WordFragment values that contain external file dependencies (images, charts and external files), keeps and restores the preset value of CreateDocx::$returnDocxStructure, replaceList allows using sub-arrays and applies htmlspecialchars to all contents when using replaceText (Premium licenses).
- Added hidden, semiHidden, unhideWhenUsed, locked and next options to createParagraphStyle, createCharacterStyle and createTableStyle methods.
- New descr option in addImage to set a custom descr value instead of the image path.
- Uppercase DOCX extension can be used in the whole library.
- importStyles generates a random name value when importing a custom paragraph style with a numbering style.
- Improved DOCXPath and DOCXCustomizer when working with multiple sections that contain multiple headers and footers (Premium licenses).
- importHeadersAndFooters includes a new parameter to set extra options such as setDefault to set the imported headers/footers as default instead of the preset type.
- Added to the internal base template the w15 namespace in the numbering XML file.
- Improved PDF methods when working with documents that include annotations (Premium licenses).
- watermarkRemove uses DOCXStructure to read and save documents (Advanced and Premium licenses).
- The htmlspecialchars PHP function to convert protected XML characters has been added to be applied automatically to the following methods and options: url option in addLink; name, title, haxLabel and vaxLabel options in addChart; textComment, initials and author options in addComment; textEndnote option in addEndnote; textFootnote option in addFootnote; defaultValue and selectOptions options in addFormElement; descr option in addImage; textBefore and textAfter options in addMergeField; createProperties method; placeholderText and alias options in addStructuredDocumentTag; text option in watermarkDocx; modifyInputFields method.
- Replaced exit calls in chart, watermark and sign classes by exceptions.
- replaceChartData uses the default temp folder to generate the temp XLSX files to be added to the document (Advanced and Premium licenses).
- Removed the old symfony bundle from the namespaces package. A standard integration with Symfony is available on the documentation pages of the website (Advanced and Premium licenses).
- Removed OdfConverter and openoffice folders from the package. Only used by the deprecated conversion plugin based on OpenOffice (Advanced and Premium licenses).
- Removed TCPDF as conversion plugin native method and unnecessary files in the fonts folder. DOMPDF is now used by default as conversion plugin native method (Advanced and Premium licenses).

11.0 VERSION

- New HTML API: more than 90 new supported tags, attributes and styles.
- CSS Extended: apply phpdocx styles from custom CSS, use font-face style to embed TTF fonts (Premium licenses).
- PHP 8 support.
- Supported ${ } to wrap placeholders in templates.
- HTML to DOCX: SVG support to add images as URL, base64 and using svg tags (ImageMagick PHP extension is needed).
- Insert custom images as bullets when adding lists with a custom list style.
- HTML Extended new option, mixPlaceholderStyles, to mix existing placeholder pPr and rPr styles when being replaced by HTML (Premium licenses).
- Added support in Indexer for online images (Advanced and Premium licenses).
- PDFUtilities includes addBackgroundImage to add a background image to PDF documents (Advanced and Premium licenses).
- HTML Extended: allows using HTML Extended block contents embedded in other tags, added new tag to insert online videos, transform HTML tabs (&#9; instead of &emsp;) (Premium licenses).
- Added support for overriding styles in level lists with mergeDocx (Advanced and Premium licenses).
- DOCX to HTML: improved handling table borders and rowspans, and multiple checkboxes in the same paragraph (Advanced and Premium licenses).
- New option to apply custom paragraph styles to the generated TOC contents.
- addSection and modifyPageLayout allow setting a space option to specify the spacing between columns and generate custom column layouts.
- addImage and replacePlaceholderImage include support for BMP images.
- DOCXCustomizer supports setting the space property in sections (Premium licenses).
- LibreOffice 7 support when using the conversion plugin (Advanced and Premium licenses).
- Embed fonts method prevents adding duplicated fonts (Advanced and Premium licenses).
- New option in the conversion plugin based on LibreOffice to include extra parameters when doing the conversions (Advanced and Premium licenses).
- HTML to DOCX: MathML equations can be embedded and converted in the HTML when using embedHTML and replaceVariableByHTML (Premium licenses).
- HTML to DOCX: changed the order of \n and \r\n when using the removeLineBreaks option.
- HTML to DOCX: set 9999999999 as default wrap value when using Tidy to prevent Tidy versions not working correctly with 0 value to avoid extra blank spaces.
- HTML to DOCX: lists with and without custom list styles can be added at the same time when setting customListStyles as true.
- HTML to DOCX: DefaultParagraphFontPHPDOCX sets as default rStyle when generating links.
- Fixed misspelled styleEmbedding option in embedFont (Advanced and Premium licenses).
- Limited numId values in lists to 32767 to prevent a bug of some DOCX readers if the value is higher.
- addLink includes rStyle option to apply a custom style to the hyperlink (DefaultParagraphFontPHPDOCX is set as default).
- Added support for orientation and axPos properties in addChart.
- Added an extra check to get the correct image type when working with image streams.
- The createListStyle method includes suff option to set level suffix: tab, space or nothing.
- Pie and doughnut charts support formatCode option. Pie charts support formatDataLabels option.
- All samples include new comments.
- Limited the max values of numId attributes used in lists.
- optimizeTemplate uses DOCXStructure to read and save documents (Premium licenses).
- Scatter charts support adding multiple series.
- Updated images and templates in samples.

10.0 VERSION

- Bulk processing: get the maximum performance and flexibility when working with templates (Premium licenses only).
- New method to import contents from an existing DOCX: importContents (Premium licenses only).
- All PDF methods now include a new option to import and keep existing annotations (links, comments and others) (Advanced and Premium licenses only).
- Embed fonts (Advanced and Premium licenses only).
- New conversion plugin method based on DOMPDF (Advanced and Premium licenses only).
- HTML Extended: new method, addBaseCSS, to apply base CSS to all imported HTML (Premium licenses only).
- HTML Extended: new option, stylesReplacementType, to keep existing placeholder pPr and rPr styles when being replaced by HTML (Premium licenses only).
- HTML Extended: support overwriting styles in level lists, transform HTML tabs (&emsp;) and allow setting targets to tag contents (Premium licenses only).
- addMathEquation now supports setting bold, color, italic and font size styles.
- HTML to DOCX avoids using a temp folder when adding an image with PHP 5.4 or newer.
- HTML to DOCX cleans gridCol 0 values, tables with not all widths set can be used.
- HTML to DOCX: new option, cssEntityDecode, to use html_entity_decode to parse CSS, useful for font families with non-ASCII names.
- HTML to DOCX: new option, forceNotTidy, to force not using Tidy. Only recommended if Tidy can't be installed.
- HTML to DOCX allows applying custom list styles to ol tags.
- DOCX to HTML: WMF images support (Advanced and Premium licenses only).
- Theme charts with addChart new options: theme legends (bold, italic, size, underline), grid lines (cap type, color, dash type, width) in charts using addChart (Premium licenses only).
- Footer support when adding watermarks with watermarkDocx (Advanced and Premium licenses only).
- The addCrossReference method now allows setting bookmark text and above/below as field content and custom modifiers.
- New method to insert table of figures: addTableFigures.
- New method to insert standalone WordFragment objects: addWordFragment.
- New method to add online videos: addOnlineVideo. Only compatible with MS Word 2013 and newer (Advanced and Premium licenses only).
- New script to check the correct configuration of the conversion plugin based on LibreOffice (Advanced and Premium licenses only).
- New method to get the document statistics based on the msword conversion plugin (Advanced and Premium licenses only).
- Added support for in-memory documents in DOCXPathUtilities: removeSection, splitDocx (Premium licenses only).
- Added support for in-memory documents in importStyles and importListStyle (Premium licenses only).
- Adding captions in images and tables support setting a custom label.
- Added support to add a caption to a table using addTable.
- Strict variant support (Premium licenses only).
- PhpdocxUtilities now allows changing the INI settings dynamically.
- DOCX to HTML: force span styles to avoid overwriting issues when document default styles are set, support zero values when using bold and italic styles, improved inheritance when applying custom paragraph and character styles, support of w:outlineLvl tags in styles to generate heading tags, added support when tcBorders tags don't have any children, improved hanging attributes and tab contents, span with a tabcontent class is used to transform tab tags (Advanced and Premium licenses only).
- DOCX to PDF: force span styles to avoid overwriting issues when document default styles are set, support zero values when using bold and italic styles, improved margins in paragraphs to avoid extra spacings, improved inheritance when applying custom paragraph and character styles (Advanced and Premium licenses only).
- getStatistics now returns an Exception if the stats file can't be created (Advanced and Premium licenses only).
- New option in SignPDF to set the page number of the image (Premium licenses only).
- Updated createDocxAndDownload to allow using '/' as directory separator on Windows.
- Indexer extracts link contents from rels files and alt text title and description contents from images (Advanced and Premium licenses only).
- DOCXCustomizer supports w:eastAsia when setting fonts (Premium licenses only).
- The addChart method now allows forcing smooth option as 0.
- processTemplate allows using singular nouns to set targets.
- The license checking avoids throwing a notice if no $_SERVER['SERVER_ADDR'] is set.
- Renamed show_label to showLabel to add captions.

9.5 VERSION

- Theme charts with addChart: set custom chart colors for series and values, add background colors to charts, plot and legend areas, rotate text contents in vertical and horizontal axis, style (bold, italic, size, underline) vertical and horizontal axis (Premium licenses only)
- DOCXPath supports headers and footers: insertWordFragment (insert contents), removeWordContent (delete existing contents), replaceWordContent (replace contents for WordFragments) and getDOCXPathQueryInfo, based on contents, sections, types and positions. All these methods are compatible with new documents and templates and simplify low level document edition (Advanced and Premium licenses only)
- New method to merge documents at any position of the first DOCX merged: mergeDocxAt (Advanced and Premium licenses only)
- HTML extended: new data- attributes to set custom styles in HTML tags not supported by standard HTML tags and CSS styles, added support for modifyPageLayout as HTML tag, getTagsInline and getTagsBlock as static methods (Premium licenses only)
- Many improvements when working with importListStyle using multiple styles and sources
- PHP 7.4 support
- DOCX merging allows returning in-memory DOCX (Premium licenses only)
- DOCX merging supports commentExtended contents (Advanced and Premium licenses only)
- DOCXCustomizer supports headers and footers (Premium licenses only)
- Improved numberings in paragraph styles: parseStyles and mergeDocx support
- getWordContents supports headers and footers (Advanced and Premium licenses only)
- List improvements: addList and createListStyle support overwriting styles in level lists
- New method to import chart styles (colors and style XML files): importChartStyle (Premium licenses only)
- addChart allows setting custom legends when adding a scatter chart. Default value is 'Y values'
- addShape supports adding text contents in shapes
- HTML to DOCX: table cell margins using padding-left and padding-right styles, apply run-of-text styles to checkboxes and radio buttons, font-weight supports 700, 800 and 900 as bold values, custom character styles support in span tags, supported text-align in run-of-text styles
- DOCX to HTML: image alignment when setting a wrapper paragraph align, the default conversion plugin normalize decimal values to force using dots in decimal values, handled underline style as none when no val is set, added support when mixing bold styles in paragraph and run-of-text styles, handle TOC anchors, added addDefaultStyles as option to manage if the default styles from the DOCX are added, default styles are applied to block tags and span tags, numbering transformations improved to support numberings such as 1.1 1.2... and numbering in custom paragraph styles, support for w:tab as &emsp;, new option includeBlankSpacesInEmptyParagraphs to add blank spaces in empty paragraphs, improved importing tables with multiple colspan values
- DOCX to PDF native method: default styles support, image alignment when setting a wrapper paragraph align, the default conversion plugin normalize decimal values to force using dots in decimal values, handled underline style as none when no val is set, added support when mixing bold styles in paragraph and run-of-text styles, removed PHP notices when calling external CSS classes, numbering transformations improved to support numberings such as 1.1 1.2... and numbering in custom paragraph styles, improved importing tables with multiple colspan values
- watermarkDOCX now accepts adding watermarks per section (Advanced and Premium licenses only) and supports in-memory DOCX documents (Premium licenses only)
- New option in the createParagraphStyle method to add numbering styles to custom paragraph styles: numberingStyle
- Support for adding page numbering as inline WordFragment
- docxSettings includes a new option to remove the compatibility mode Word message and add compatibility setting tags: compat
- replaceWordContent allows setting location values: after (default), before, inlineBefore or inlineAfter (don't create a new w:p and add the WordFragment before or after the referenceNode, only inline elements)
- Removed the path option in parseStyles
- Cleaned PHP notices
- Updated the included file Test.mht

9.0 VERSION

- HTML extended: call phpdocx methods from custom HTML tags to add headers, footers, comments, page number, TOC, WordFragments and many other contents (Premium licenses only)
- Tracking support: add people, track new, replaced and removed contents and styles, accept and reject existing trackings, get tracking information (Premium licenses only)
- Native PHP conversion from DOCX to PDF (Advanced and Premium licenses only)
- Huge performance improvement in HTML to DOCX transformations: 60% less memory used and 15% faster (average)
- New method to extract and analyze styles in the main document body: getWordStyles (Advanced and Premium licenses only)
- New options in the conversion plugin based on LibreOffice: export comments (inline and margins), export form fields (structured document tags: input and select) and lossless compression
- Added support for generating the Table of contents automatically with the conversion plugin with msword (Advanced and Premium licenses only)
- HTML to DOCX: added support for custom paragraph styles in LI tags and the start attribute in OL tags, removed two notices when using PHP 7.2 or newer and solved the Font_Metrics error when using not valid fonts
- New method to extract existing files from the DOCX: getWordFiles (Advanced and Premium licenses only)
- Improved performance when generating charts: external files to create them has been moved to an internal PHP structure file
- New styles added to createListStyle: align and position
- Indexer now extracts people, sections information and styles of documents (Advanced and Premium licenses only)
- Support for in-memory DOCX using Indexer (Premium licenses only)
- Added pageNumberType as option to addSection and modifyPageLayout methods to set page number format and start values
- New signature of the method transformDocument
- New option to avoid using a wrap value with Tidy to prevent extra blank spaces when transforming HTML to DOCX: disableWrapValue
- Added to watermarkDocx a new option to force the conversion plugin based on LibreOffice showing text watermarks: add_vshapetype_tag (Advanced and Premium licenses only)
- Improvements in DOCX to HTML: support for sdt tags when wrapping cell tables, added default values for margin-top and margin-bottom in the base CSS of the default plugin, supported nil as value in internal cells of tables, added support of the start attribute in lists
- Now AES-256-CBC is used in the encryptDOCX method to get the cipher iv length
- Updated the function to get the dpi value from PNG images
- The enableCompatibilityMode method has been removed
- Added an extra check to detect the image file extension in HTML to DOCX methods when the image doesn't have an extension
- The static wordML variable in HTML2WordML has been replaced by a protected variable
- The transformDocxUsingMSWord method has been removed from the Basic license and added as new conversion plugin with new options (Advanced and Premium licenses only)
- Updated the included version of TCPDF to the latest release

8.5 VERSION

- MS Word 2019 support
- XLSX and PPTX utilities: sign, encrypt and change contents (Premium licenses only)
- PHP 7.3 support
- New method to optimize DOCX files that reduces their sizes while keeping contents and styles: optimizeDocx (Advanced and Premium licenses only)
- New option for HTML to DOCX methods to generate MS Word list styles automatically from HTML and CSS. Supported list styles: decimal, lower-alpha, lower-latin, lower-roman, upper-alpha, upper-latin, upper-roman
- DOCX to HTML improvements: support for paragraph and table default styles set by a w:style tag with a w:default="1" property, w:cs attributes when w:ascii doesn't exist in font tags, new default values for top and bottom margins when they are not set in the DOCX, added a default HTML content for empty contents such as paragraphs, better support for insideH, insideV, band1Horz, band2Horz, firstCol, lastCol, firstRow, lastRow tags and styles in tables, increment heading indexes automatically based on style and occurrence values (Advanced and Premium licenses only)
- PDF output stream mode support for mergePdf, removePagesPdf and watermarkPdf methods (Premium licenses only)
- PDFUtilities, new method to remove pages in PDFs: removePagesPdf (Advanced and Premium licenses only)
- Added support for base64 images in embedHTML and replaceVariableByHTML methods
- Set downloadImages as true by default in embedHTML and replaceVariableByHTML methods
- New method to create custom table styles: createTableStyle
- Added support for completed comments. Only compatible with MS Word 2013 and newer
- New method to set comments as completed or not completed: changeStatusComments. Only compatible with MS Word 2013 and newer (Advanced and Premium licenses only)
- Replaced the create_function function if PHP 5.3 or newer when using HTML import methods. Replaced by an anonymous function
- Indexer now shows the fonts used in the document (Advanced and Premium licenses only)
- Added revision value to the addProperties method
- Removed a warning message when merging PDFs with Index elements using PHP 7.2 or newer (Advanced and Premium licenses only)
- Updated check.php to test phpdocx requirements

8.2 VERSION

- New class to get DOCX documents from any stream to be used as templates or for merging (Premium licenses only)
- PHP 7.2 compatibility: OpenSSL support and removed PHP deprecated messages
- Added a new option in cloneBlock to allow cloning blocks and subblocks by position (Advanced and Premium licenses only)
- New options for signPDF to add supplementary data, customize the signature and add an image as signature (Premium licenses only)
- Removed mcrypt methods to encrypt documents. OpenSSL is now used in the Crypto module (Premium licenses only)
- New method to customize the string used to wrap blocks: setTemplateBlockSymbol
- Block placeholders in templates don't need to be unique in templates
- New improvements added to DOCX to HTML transformation: support for comments, new checks when default styles don't exist, added links for endnote, footnote and comment references (Advanced and Premium licenses only)
- DOCXPath: much better performance when using moveWordContent and cloneWordContent (Advanced and Premium licenses only)
- Improvements for the conversion plugin when transforming HTML using colspans and rowspans in the first row (Advanced and Premium licenses only)

8.0 VERSION

- Blockchain module (Premium licenses only)
- Transform DOCX to HTML using native PHP classes (Advanced and Premium licenses only)
- New tags, styles and selectors supported when transforming HTML to DOCX: CSS3 selectors (nth-child, nth-of-type, first-of-type, last-of-type), tags (figcaption), styles (color and width for hr, margin-left and margin-right for td, auto and fixed for table-layout)
- Improved compatibility with MS Office 365 (when generating a not document.xml fixed name)
- New method to change the default styles dynamically: setDocumentDefaultStyles
- New method to transform OMML (Office MathML) equations to MathML: transformOMMLToMathML
- New internal in-memory base template to improve performance when generating DOCX documents from scratch (Premium licenses only)
- DOMPDF and TCPDF libs have been moved to internal phpdocx classes
- New method to repair automatically common issues with tables, lists and extra pages when working with the conversion plugin and LibreOffice: enableRepairMode (Advanced and Premium licenses only)
- New styles for cross-references supported
- TOCs can be added as WordFragments
- Generate automatically the TOC in a DOCX with the conversion plugin (Advanced and Premium licenses only)
- Added lastModifiedBy as option to addProperties
- replaceChartData adds editable XLSX (Advanced and Premium licenses only)
- New methods to remove headers and footers: removeHeaders and removeFooters
- Apply a format string for axis (date, percentage, currency, custom...) when adding charts
- New option to remove extra line breaks when transforming HTML to DOCX with the embedHTML method (useful for working with LibreOffice and the conversion plugin when a string doesn't have a tag wrapper)
- New option to avoid adding default styles when importing HTML
- LibreOffice 6 support when using the conversion plugin (Advanced and Premium licenses only)
- Changed INC extensions to PHP extensions for all classes
- Moved to ZIP packages
- Removed OpenOffice from the packages
- Removed log4php from the packages, any PSR3 logging library can be used

7.5 VERSION

- Charts improvements: new data structure to allow repeating name values, trend lines, combo charts, all charts can be edited when the DOCX is opened, majorUnit, minorUnit, scalingMax and scalingMin options for bar, col, line, area, radar and scatter charts, smooth option for line and scatter charts, styles for titles, show legend keys and series labels, format data labels in col and bar charts (rotation and position)
- Support for adding images as streams with addImage, replacePlaceholderImage and HTML methods
- Add charts from existing XLSX files
- Character styles support
- Improved importing tables from HTML with colspan or rowspan values
- New method to create custom character styles: createCharacterStyle
- New styles for paragraphs, headings, links, texts and styles: double strike through, vanish, scaling, position, underline color, character spacing and character borders
- The conversion plugin allows to transform DOCX to XHTML (HTML is supported since phpdocx 4.5)
- New options for addImage: relativeToHorizontal and relativeToVertical to add images relative to page, margins, columns and other positions in the document
- Improved merging of DOCX that include list styles with images or themed charts
- Set protected and editable regions using CryptoPHPOCX
- Set math equations alignments
- SignDocx allows adding multiple signatures
- XMLAPI content can be added as strings and added a stream mode option
- The getDocxPathQueryInfo method of DOCXPath returns the elements of the query to be changed or queried
- New option to set continue numbering in lists
- New option to set a start value with createListStyle
- Set custom settings using the docxSettings method
- New exception thrown when phpdocx can't write to the target file

7.0 VERSION

- DOCXCustomizer: change styles of existing contents on the fly in documents created from scratch and templates (Premium licenses only)
- New cloneBlock method to clone blocks in documents (Advanced and Premium licenses only)
- DOCXPathUtilities: split DOCX, remove a section and its contents (Advanced and Premium licenses only)
- PDFUtilities: split PDF, watermark PDF (Advanced and Premium licenses only)
- DOCXPath: range of elements, iterate all elements not only the first one, siblings (Advanced and Premium licenses only)
- Merge DOCX documents using in-memory DOCX documents (Premium license only)
- replaceChartData improved to allow changing titles, legends and categories (Advanced and Premium licenses only)
- Added RTL support when importing HTML lists
- Added new functionality to Indexer: returns images sizes, charts data and document properties (Advanced and Premium licenses only)
- Joomla extension (Advanced and Premium licenses only)
- Improved replace WordFragment in headers and footers to achieve a better performance
- Use replaceListVariable and replaceTableVariable in headers and footers
- Support for PDF 1.5, 1.6 and 1.7 versions when adding watermarks, merging and signing documents
- Set created and modified dates
- Use superscripts, subscripts and strikethroughs in texts
- createDocxAndDownload improved: new option to remove the generated file after downloading it

6.5 VERSION

- Many improvements that enhances the performance of the library:
  · Generation of DOCX files doesn´t create temp files anymore, except when working with charts.
  · HTML to DOCX conversion requires less time and memory.
  · New option to generate DOCX files as a stream instead of physical files (Premium license only).
  · New class to optimize templates and decrease required time to replace placeholders (Premium license only).
  · It loads the base template in memory instead of saving it as a physical file (Premium license only).
  · New method to load templates in memory, which allows serializing them (Premium license only).
  · Support for HHVM (http://hhvm.com) (Premium license only).
- Indexer: a new class to extract and parse the content of the documents: body, comments, endnotes, footers, footnotes, headers, images and links (available for Advanced and Premium licenses).
- DOCXPATH: new method to extract text contents from documents using DOCXPATH queries
- replaceListVariable and replaceTableVariable options now support the use of WordFragments as values.
- New methods to clone and move contents with DocxPath (available for Advanced and Premium licenses).
- New option to add URLs in images with addImage.
- New option to apply the WordFragments styles when placing content in lists.
- rawSearchAndReplace, a new method that replaces strings in any XML file of a DOCX.
- Added page-of option to insert numberings of the "page X of Y" kind.
- Removed the deprecated constructor messages in FPDI when using PHP 7.
- Htmlawed updated to the last available version.

6.0 VERSION

- DOCXPath: A new class for adding WordFragments, replacing contents for WordFragments and deleting existing contents in the main document. It is compatible with new documents and templates and simplifies low level document edition with a new set of easy to use methods.
- WYSIWYG editor: Many improvements to create a WYSIWYG editor for generating DOCX or PDF files. Support for new styles and tags in HTML to DOCX conversion. It includes the recommended configuration for CKEditor (http://ckeditor.com).
- Crossreferences: Support for adding cross-references in the document.
- Import list styles: Import styles from existing lists to apply them in new documents and templates.
- Parse carriage returns for parseLineBreaks option: Makes possible to use literals like '\n' and carriage returns like "\n" with the parseLineBreaks option.
- PhpdocxLogger may be disabled: A new method to completely disable the logger.
- Styles for image captions: New parameters for adding styles to image captions.
- XXE automatically instead of as an option: It integrates automatic protection against XXE attacks (https://www.owasp.org/index.php/XML_External_Entity_(XXE)_Processing).
- Drupal 8 module: A new module to use phpdocx with Drupal 8.
- Chart new options: New options to define maximum and minimum range of line and bar charts.
- replaceVariableByText by raw elements: It allows to replace any existing string text in a document for other string text.

5.5 VERSION

- A document statistics module: counts and prints the number of pages, words, characters, paragraphs, lines, tables and images. Only for Corporate and Enterprise licenses.
- LibreOffice version 5 improvements: phpdocx and LibreOffice are even more compatible. With phpdocx 5.5 you can generate better looking docx. Also, to convert PDFs is easier, as it automates the process even more.
- Phar for namespaces packages: install and use phpdocx copying a single PHAR file. Only for Corporate and Enterprise licenses.
- WordFragments support for math equations.
- Improved clean temp files: Now phpdocx deletes temporal files more efficiently.
- Emphasis mark type support.
- Adding image captions.

5.1 VERSION

- Added support for PHP 7.

5.0 VERSION

- XML Api: An API for document generation without PHP knowledge. Its easy tagging allows to access the phpdocx methods as well as working with templates. This feature doesn´t require any programming skills. Only available for Corporate and Enterprise licenses.
- Logger: Phpdocx runs an inside logger. From version 5.0 on, phpdocx allows to use a custom logger that complies with the PSR-3 Logger interface.

4.6 VERSION

This new version adds support to generate and transform the Table of contents (TOC) when using the conversion plugin, replaces placeholder in headers and footers by WordFragments and adds a new option to solve the CVE-2014-2056 vulnerability.

4.5 VERSION

This version includes a new conversion plugin that uses LibreOffice as the transformation tool. It doesn't need OdfConverter to transform the documents.

Both LibreOffice and OpenOffice suites are supported.

The Corporate and Enterprise licenses include plugins to use phpdocx with Drupal, WordPress, Symfony and any framework or development that use composer.

4.1 VERSION

This new version adds support for charts when the documents are transformed to PDF (using JpGraph http://jpgraph.net or Ezcomponents http://ezcomponents.org) and a new package that includes namespaces support.

The namespaces package is only available for Corporate and Enterprise licenses.

4.0 VERSION

This new major version represents a big step forward regarding the functionality and scope of PHPDocX.

The most important change introduced in this new version is that it removes all the restrictions regarding custom templates that were limitating previous versions.

With PHPDocX 4.0 one may use concurrently the standard template methods of the past (that have also been improved and refactored) with any of the core PHPDocX methods. This means in practice that one is not limited to modify the contents of a custom by simply replacing variables but that one may insert arbitrary Word content anywhere within the template.

Another important new feature is the introduction of "Word fragments" that allow for a simpler and more flexible creation of content. One may create a Word fragment with arbitrary content: paragraphs, lists, charts, images, footnote, etcetera and later insert it anywhere in the Word document in a truly simple and transparent way.

The main changes can be summarized as follows:

CORE AND TEMPLATES:
      * Completely refactored CreateDocx class and a completely new CreateDocxFromTemplate class that extends the former and allows for a complete control of documents based on custom templates.
      * New WordFragment class that greatly simplifies the process of nesting content within the Word document.
      * Complete refactoring of the prior template methods that allow for higher control and the replacement of variables by arbitrarily complex Word fragments.
      * createListStyle: greater choice of options for the creation of custom list styles.
      * addTextBox: includes now new formatting options and it is easier to include arbitrary content within textboxes.
      * insertWordFragmentBefore/After: allows to include content anywhere within a Word template.

DOCX UTILITIES PACKAGE
      * MultiMerge: much faster API that allows for the merging of an arbitrarily large number of Word documents with just
      one line of code.

CONVERSION PLUGIN
     * The conversion of numbered lists has been greatly improved as well as the handling of sections with multiple columns.

Besides these new classes and methods we have also included some minor bug fixes and multiple improvements in the API including extra options and a uniformization the typing and units conventions.

3.7 VERSION

The main goal of this version is to allow for the generation of "right to left language" (like, for example, Arabic or Hebrew) Word documents with PHPDocX.

It is now possible to set up global RTL properties that affect the whole document or to stablish them for just some particular elements like paragraphs, tables, etcetera.

The following methods/classes/files have been added or modified:

CORE:
      * phpdocxconfig.ini now admits to new global options: bidi and rtl.
      * setRTL: allows to set global RTL properties for a particular document.
      * embedHTML: now the HTML parser supports HTML and CSS standard RTL options.
      * The following methods allow for rtl options:
               * addSection
               * modifyPageLayout
               * addDateAndHour
               * addEndnote
               * addFootnote
               * addFormElement
               * addLink
               * addMergeField
               * modifyPageLayout
               * addPageNumber
               * addSimpleField
               * addStructuredDocumentTag
               * addTable
               * addTableContents
               * addSection
               * addText
        * createListStyle: allows now to use custom fonts for bullets.

DOCX UTILITIES PACKAGE
      * The merging includes some improvements for images included within shapes.

CONVERSION PLUGIN
     * There is a new debugging mode to simplify the installation process.

3.6 VERSION

CORE:
      * addMergeField: it is now posible to include standard Microsoft Word merge fields. Although PHPDocx has its own protocols for the substitution of variables several of our clients have requested this feature to allow further manipulations in Microsoft Office with the generated docx files.
      * modifyInputField: together with the tickCheckbox method allows to fulfill forms integrated in a template.

DOCX UTILITIES PACKAGE
      * It is now possible to enforce section page breaks when merging documents even when the original documents have continuous section types

CONVERSION PLUGIN
     * We have included extra preprocessing of the documents prior to conversion to improve table rendering.

The package now includes an improved version of check.php that outputs info useful to debug any issue or problem related to the license or the library.

3.5.1 VERSION

This minor version includes:
    * New version of check.php script that includes license info and better guidance for the installation of the conversion plugin.
    * Improvements in the PDF conversion plugin.
    * Several improvements for the embedding of HTML into Word.
    * Minor bug fixes.

3.5 VERSION

This version includes several changes that greatly improve the core functionality of PHPDocX and in particular the conversion of HTML into Word.

CORE:
      * addComment: it is now posible to include Word comments that may incorporate complex formatting as well as images and HTML content. It is also posible to fully customize the comment properties and reference marks.
      * addFotnote and addEndnote: these methods have been completely refactored to leverage their capabilities to the new addComment method, therefore it is now posible to create truly sophisticated endnotes and footnotes.
      * createListStyle: one may now create fully customized list styles that may be used directly in conjunction with the addList method or  with the embedHTML/replaceTemplateVariable BYHTML methods (seee below).
      * createParagraphStyle: simplify your coding creating reusable custom paragraph styles that incorporate multiple formatting options (practically the full standard).
      * lineNumbering: it is posible now to insert customized line numbering in your Word document.
      * addPageBorders: its name explains it all (custom border types, colors, width, ...).
      * addText: it is now posible to customize paragraph hanging properties and indent the first line of text.
      * addMathMML: refactored to include inline math equations.

HTML2DOCX
      * 'useCustomLists' option: it allows to mimic sophisticated CSS list styles with PHPDocX. One should create first a custom list style via the createListStyle method with the same name as the CSS style that one wants to reproduce and if this option is set to true the corresponding Word list style will be used.
      * General improvements in the format rendering of list elements and table cells (in particular with sophisticated row and colspan layouts).

DOCX UTILITIES PACKAGE
      * setLineNumbering: allows for the modification of the line numbering properties of an existing Word document.

CONVERSION PLUGIN
     * New integrated versions of ODFConverter for Linux 64-bit OS and Windows.

3.3 VERSION

This new version includes some changes that greatly improve the PHPDocX functionality. There are several brand new methods:

CORE:
      * addSimpleField: allows for the insertion of standard Word fields in the body of the document sucha as the number of pages, document title, author, creation date, etecetera.
      * addHeading: to insert standard Word headings that may be directly included in the Table of Contents.
      * docxSettings: this method allows you to modify many of the general properties of a Word document such as the zoom on openning, the printing options, to show or hide grammar and spelling, etcetera.

TEMPLATE MANAGEMENT
      * tickCheckbox: one may now tag standard Word checkboxes in a given template and later change theirs state with the help of this useful method.

DOCX UTILITIES PACKAGE
      * modifyDocxSettings: allows for the modification of the general properties of a given pre-existing Word document. One may, for example, change the zoom properties on openning of all the documents contained in a folder with a few lines of PHP code.
      * parseCheckboxes: With the help of this method one may tick or not all the checkboxes of a given pre-existing Word document.

Besides these new methods we have improved previously existing functionality:
      * embedHTML: we improved the management of CSS page break properties and HTML line breaks.
      * addDocx: we have included the OOXML "matchSource" property to improve the rendering of embedded docx document when there are conflicting styles.
      * addTemplateVariable: we have "removed the extra empty line" that was added when replacing a template variable by a DOCX, HTML, MHT or RTF file.
      * Minor bug fixes.

We have also restructured the API documentation to simplify the access to relevant information. We have also included in the v3.3 package a refined version of  the "installation script" that now checks not only for the PHP modules required by PHPDocX but also permission rights as well as the correct installation of the PDF conversion plugin (both via web or CLI).

3.2 VERSION

This version includes some important changes that greatly improve the PHPDocX functionality:

- It is now possible to create really sophisticated tables that practically covered all posibilities offered by Word:
      * arbitrary row and column spans,
      * advanced positioning: floating, content wrapping, ...,
      * custom borders at the table, row or cell level (type, color and width),
      * custom cell paddings and border spacings,
      * text may be fitted to the size of a cell,
      * etcetera
- There are several brand new methods:
      * addStructuredDocumentTags: that allows for the insertion of combo boxes, date pickers, dropdown menus and richtext boxes,
      * addFormElement: to insert standard form elements like text fields, check boxes or selects,
      * cleanTemplateVariables: to remove unused PHPDocX template variables together with is container element (optional) from the resulting Word template.
- It is now posible to insert arbitrarily complex tabbed content into the Word document (tab positions, leader symbol and tab type).
- There is a new UTF-8 detection algorithm more reliable that the standard PHP one based on mb_detect_encoding
- There is a new external config file that will simplify future extensibility

Besides these improvements, PHPDocX v3.2 also offers:
- Minor improvements in the addText method: one may use the caps option to capitalize text and it is now easier to set the different paragraph margins.
- Minor bug fixes

3.1 VERSION

This new version includes quite a few new features that you may find interesting:

- It is now posible to insert arbitrary content within a paragraph with the updated addText method:
      * multiple runs of text with diverse formatting options (color, bold, size, ...)
      * inline or floating images and charts that may be carefully positioned  thanks to the new vertical and horizontal offset parameters
      * page numbers and current date
      * footnotes and endnotes
      * line breaks and column breaks
      * links and bookmarks
      * inline HTML content
      * shapes
- In general the new addText method accepts any inline WordML fragment. This will make trivial to insert new elements in paragraphs as they are integrated in PHPDocX.
- We have greatly improved the automatic generation of the table of Contents via the addTableContents method. One may now:
      * request automatic updating of the TOC on the first openning of the document (the user will be automatically prompted to update fields in the Word document)
      * limit the TOC levels that should be shown (the default value is all)
      * import the TOC formatting from an existing Word document
- The addTemplateImage has now more configuration options so it is no longer necessary to include a placeholder image with the exact size and dpi in the PHPDocX Word template. Moreover one can now use the same generic placehorder image for the whole document simplifying considerably the process.
- The logging framework has been updated to the latest stable version of log4php.
- You may now use an external script to transform DOCX into PDF using TransformDocAdv.inc class. This script fixes the problems related to runnig system commands using Apache or any other not CGI/FastCGI web server.

Besides these improvements v3.1 also offers:
- Minor improvements in the HTML to Word conversion: one may change the orientation of text within a table cell and avoid the splitting of a table row between pages.
- New configuration options for the addImage method
- Now it is simpler to link internal bookmarks with the addLink method
- When merging two Word documents one can choose to insert line breaks between them to clearly separate the contents
- One may import styles using also their id (this may simplify some tasks)
- Minor bug fixes

3.0 VERSION

This version includes substantial changes that have required that this new version were not fully backwards compatible with the latest v2.7.

Nevertheles the changes in the API are not difficult to implement in already existing scripts and the advantages are multiple.

The main changes are summarized as follows:

- The new version handles in a different way the embedding of Word elements within other elements like tables, lists and headers/footers. The
majority of methods have now a 'rawWordML' option that in combination with the new 'createWordMLFragment' allows for the generation of chunks of
WordMl code that can be inserted with great flexibility anywhere within the Word document. its is now, for example, trivial to include paragraphs,
charts, tables, etcetera in a table cell.
-One may create sophisticated headers and footers with practically no restriction whatsoever by the use of the 'createWordMLFragment'  method.
-The embedHTML and replaceTemplateVariableByHTML have been improved to include practically all CSS styles and parse floats. It is also posible now
to filter the HTML content via XPath expressions and associate different native Word styles to individual CSS classes, ids or HTML tags.
-New chart types have been included: scatter, bubbles, donoughts and the code has been refactor to allow for greater flexibility.
-The addsection method has been extended and improved.
-The addTextBox method has been greatly improved to include many more formatting options.
-The refactored addText method allows for the introduction of line breaks inside a paragraph.
-New addPageNumber method
-New addDateAndHour method

2.7 VERSION

The main differences with respect the prior stable major version PHPDocX v2.6 can be summarized as follows:

- New chart types: percent stacked bar and col charts and double pie charts (pie or bar chart for the second one)
- Improvements in the HTML parser (floating tables, new CSS properties implemented)
- Now is posible to insert watermarks (text and/or images)
- New CryptoPHPDocX class (only CORPORATE) that allos for password protected docuemnts
- Automatic leaning of temporary files
- New method: setColorBackgraound to modify the background color of a Word document
- Several other minor improvements and bug fixes

2.6 VERSION

The main improvements are:

New and more powerfull conversion plugin for PRO+ and CORPORATE packages.
New HTML parser engine for the embedding of HTML into Word: 20% faster and up to 50% less RAM consumption.
New HTML tags and properties parsed (now covering practically the whole standard):
 -HTML headings become true Word headings
 -Flaoting images are now embedded as floated images in Word
 -Anchors as parsed as links and bookmarks
 -Web forms are converted into native Word forms
 -Horizontal rulers are also parsed into Word
 -Several other minor improvements and bug fixes
New addParagraph method that allows to create complex paragraphs that may include:
 -Formatted text
 -Inline or floating images
 -Links
 -Bookmarks
 -Footnotes and endnotes
New addBookmark method
Improvements in the DocxUtilities class (only PRO+ and Corporate licenses): improved merging capabilities that cover documents with charts, images, footnotes, comments, lists, headers and footers, etcetera.

2.5.2 FREE VERSION
- Docx to TXT to convert Docx documents to pure text

2.5.2 PRO VERSION
- New format converter for Windows (MS Word must be installed)
- Now you can replace the image in headers
- New method DocxtoTXT to convert docx documents to pure text
- Better implementation of HTML to WORDML
- Bug fixes

2.5.1 PRO VERSION
One of the most demanded functionalities by PHPDocX users is the posibility to generate Word documents out of HTML retaining the format and construct documents with different HTML blocks. Now we give a little step to make this functionality more powerful.

Since the launch of the 2.5.1 version of PHPDocX we have at your disposal two new methods: embedHTML() and replaceTemplateVariableByHTML() - new on this version- that allow to convert HTML into Word with a high degree of customization.

Moreover this conversion is obtained by direct translation of the HTML code into WordProcessingML (the native Word format) so the result is fully compatible with Open Office (and all its avatars), the Microsoft compatibility pack for Word 2003 and most importantly with the conversion to PDF, DOC, ODT and RTF included in the library.

2.5 PRO VERSION
This version of PHPDocX includes several enhancements that will greatly simplify the generation of Word documents with PHP.
The main improvements can be summarized as follows:
- New embedHTML method that:
	o Directly translates HTML into WordProcessingXML.
	o Allows to use native Word Styles, i.e. we may require that the HTML tables are formatted following a standard Word table style.
	o Is compatible with OpenOffice and the Word 2003 compatibility pack.
	o May download external HTML pages (complete or selected portions) embedding their images into the Word document.

- PHPDocX v2.5.1 now uses base templates that allow:
	o To use all standard Word styles for:
		- Paragraphs.
		- Tables with special formatting for first and last rows and columns, banded rows and columns and another standard features.
		- Lists with several different numbering styles.
		- Footnotes and endnotes.
	o Include standard headings (numbered or not).
	o Include customized headers and footers as well as front pages.

- There are new methods that allow you to parse all the available styles of a Word document and import them into your base template:
	o parseStyles  generates a Word document with all the available styles as well as the required PHPDocX code to use them in your final Word document (you may download here the result of this method applied to the default PHPDocX base template).
	o importStyles allows to integrate new styles  extracted from an external Word document into your base template.

- New conversion plugin (based on OpenOffice) that improves the generation of PDFs, RTFs and legacy versions of Word documents.

- New standardized page layout properties (A4, A3, letter, legal and portrait/landscape modes) trough the new modifyPageLayout method.

- The addTemplate method has been upgraded to greatly improve its performance.

- You may directly import sophisticated headers and footers from an existing Word document with the new  importHeadersAndFooters method.

As well as many other minor fixes and improvements.
We have also upgraded our documentation section by simplifying the access to the available library examples and we have included a tutorial that will help newcomers to get grasp of the power of PHPDocX.