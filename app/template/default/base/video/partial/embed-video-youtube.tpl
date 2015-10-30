<?php echo $iframe; ?>
<script type="text/javascript">
    (function (d) {
        var id = "<?php echo $id; ?>";
        var v = d.getElementById(id);
        var w = v.parentElement.offsetWidth;
        var h = Math.floor(w * 337 / 600);
        v.setAttribute('height', h);
    })(document);
</script>