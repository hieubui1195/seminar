<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
    body {
        font-family: DejaVu Sans;
    }
</style>

<body>
    {!! $report->report !!}
</body>

<script type="text/php">
if (isset($pdf)) {
    $pdf->page_script('
        if ($PAGE_COUNT > 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 12;
            $pageText = $PAGE_NUM . "/" . $PAGE_COUNT;
            $y = 730;
            $x = 550;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}
</script>
